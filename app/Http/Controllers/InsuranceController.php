<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Insurance;
use App\Models\Vehicle;

class InsuranceController extends Controller
{
    public function index($id, $vehicle_id)
    {
        $client = Client::find($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        return view('insurances.index', [
            'client'  => $client,
            'vehicle' => $vehicle,
        ]);
    }

    public function edit($id, $vehicle_id, $insurance_id)
    {
        $client = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);
        $insurance = Insurance::findOrFail($insurance_id);

        return view('insurances.edit', [
            'client' => $client,
            'vehicle' => $vehicle,
            'insurance' => $insurance,
        ]);
    }

    public function show($id, $vehicle_id, $insurance_id)
    {
        $client = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);
        $insurance = Insurance::findOrFail($insurance_id);

        return view('insurances.show', [
            'client' => $client,
            'vehicle' => $vehicle,
            'insurance' => $insurance,
        ]);
    }

    public function create($id, $vehicle_id)
    {
        $client  = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        return view('insurances.create', [
            'client'  => $client,
            'vehicle' => $vehicle,
        ]);
    }

    public function store(Request $request, $id, $vehicle_id)
    {
        $client  = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        $attributes = $request->validate([
            'or_number' => ['required'],
            'issue_date' => ['required'],
            'coc_number' => ['required'],
            'policy_number' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'premiums_paid' => ['required'],
            'amount_due' => ['required'],
        ]);

        $insurance = $vehicle->insurances()->create($attributes);

        return redirect("/clients/$id/vehicles/$vehicle_id/insurances/create")
            ->with([
                'message' => 'Successfully added insurance COC #' . $attributes['coc_number'] . '.',
                'url' => "/clients/$client->id/vehicles/$vehicle_id/insurances/$insurance->id",
            ]);
    }

    public function update(Request $request, $id, $vehicle_id, $insurance_id)
    {
        $client  = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        $attributes = $request->validate([
            'or_number' => ['required'],
            'issue_date' => ['required'],
            'coc_number' => ['required'],
            'policy_number' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'premiums_paid' => ['required'],
            'amount_due' => ['required'],
        ]);

        $insurance = $vehicle->insurances()->find($insurance_id);
        $insurance->update($attributes);

        return redirect("/clients/$id/vehicles/$vehicle_id/insurances/$insurance_id")
            ->with([
                'message' => 'Successfully updated insurance with COC #' . $attributes['coc_number'] . '.',
            ]);
    }

    public function destroy($id, $vehicle_id, $insurance_id)
    {
        $client = Client::findOrFail($id);
        $vehicle = $client->vehicles()->findOrFail($vehicle_id);
        $insurance = $vehicle->insurances()->findOrFail($insurance_id);

        $insurance->delete();

        return redirect("/clients/$id/vehicles/$vehicle_id/insurances")
            ->with([
                'message' => 'Successfully deleted insurance with COC #' . $insurance->coc_number . '.',
            ]);
    }
}
