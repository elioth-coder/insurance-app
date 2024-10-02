<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\Setting;
use App\Models\Accident;
use App\Models\InjuredPerson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ClaimController extends Controller
{
    public function verify()
    {
        return view('claims.verify');
    }

    public function accidents($serial)
    {
        $authentication = Authentication::where('coc_number', $serial)->first();
        $accidents = Accident::where('serial', $serial)->get();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('claims.accidents', [
            'authentication' => $authentication,
            'settings' => $settings,
            'accidents' => $accidents,
        ]);
    }

    public function store_accident(Request $request)
    {
        $accidentAttributes = $request->validate([
            'serial' => ['required'],
            'date_occured' => ['required'],
            'location' => ['required'],
            'details' => ['required'],
            'supporting_files.*' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf,docx', 'max:2048'],
        ]);
        $accidentAttributes['agent_id'] = Auth::user()->id;
        unset($accidentAttributes['supporting_files']);
        $accident = Accident::create($accidentAttributes);

        $folderName = 'accidents/accident_' . $accident->id;

        if ($request->hasFile('supporting_files')) {
            foreach ($request->file('supporting_files') as $file) {
                $file->storeAs($folderName, $file->getClientOriginalName(), 'public');
            }

            $accident->supporting_files = $folderName;
            $accident->save();
        }

        return redirect("/claims/process/$accident->serial")->with([
            'message' => "Successfully added the accident from $accident->location to accidents"
        ]);
    }

    public function accident($serial, $accident_id)
    {
        $authentication = Authentication::where('coc_number', $serial)->first();
        $accident = Accident::findOrFail($accident_id);
        $injured_persons = InjuredPerson::where('accident_id', $accident_id)->get();
        $folderName = 'accidents/accident_' . $accident->id;
        $accident->evidences = collect(Storage::disk('public')->allFiles($folderName))->map(fn($file) => Storage::url($file));

        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('claims.accident', [
            'authentication' => $authentication,
            'settings' => $settings,
            'accident' => $accident,
            'injured_persons' => $injured_persons,
        ]);
    }

    public function store_injured(Request $request)
    {
        $injuredPersonAttributes = $request->validate([
            'accident_id'    => ['required'],
            'name'           => ['required'],
            'address'        => ['required'],
            'contact_number' => ['required'],
            'details'        => ['required'],
            'claimable_amount'   => ['required'],
            'supporting_files.*' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf,docx', 'max:2048'],
        ]);
        $injuredPersonAttributes['agent_id'] = Auth::user()->id;
        $injuredPersonAttributes['status'] = 'For Approval';

        unset($injuredPersonAttributes['supporting_files']);
        $injuredPerson = InjuredPerson::create($injuredPersonAttributes);

        $folderName = 'injured_persons/injured_person_' . $injuredPerson->id;

        if ($request->hasFile('supporting_files')) {
            foreach ($request->file('supporting_files') as $file) {
                $file->storeAs($folderName, $file->getClientOriginalName(), 'public');
            }

            $injuredPerson->supporting_files = $folderName;
            $injuredPerson->save();
        }

        return redirect("/claims/process/" . $request['serial'] . "/$injuredPerson->accident_id?index=" . $request->query('index'))->with([
            'message' => "Successfully added $injuredPerson->name to injured persons"
        ]);
    }

    public function injured($serial, $accident_id, $injured_id)
    {
        $authentication = Authentication::where('coc_number', $serial)->first();
        $accident = Accident::findOrFail($accident_id);
        $injured_person = InjuredPerson::findOrFail($injured_id);
        $folderName = 'injured_persons/injured_person_' . $injured_person->id;
        $injured_person->evidences = collect(Storage::disk('public')->allFiles($folderName))->map(fn($file) => Storage::url($file));

        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('claims.injured', [
            'authentication' => $authentication,
            'settings' => $settings,
            'accident' => $accident,
            'injured_person' => $injured_person,
        ]);
    }

    public function approve(Request $request, $id)
    {
        $injured_person = InjuredPerson::findOrFail($id);
        $rules = [
            'claimable_amount' => ['required'],
        ];

        $injuredPersonAttributes = $request->validate($rules);
        $injuredPersonAttributes['status'] = 'Approved';
        $injured_person->update($injuredPersonAttributes);

        return redirect("/claims/process/" . $request['serial'] . "/" . $request['accident_id'] . "?index=$request->index")->with([
            'message' => "Successfully approved claim request worth P" . number_format($request->input('claimable_amount')),
        ]);
    }

    public function deny(Request $request, $id)
    {
        try {
            $injured_person = InjuredPerson::findOrFail($id);
            $rules = [
                'remarks' => ['required'],
            ];

            $injuredPersonAttributes = $request->validate($rules);
            $injuredPersonAttributes['status'] = 'Denied';
            $injured_person->update($injuredPersonAttributes);

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully denied the request',
            ]);
        } catch(Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
