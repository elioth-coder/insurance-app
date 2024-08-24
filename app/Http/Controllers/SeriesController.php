<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CocSeries;
use App\Models\CocSeriesNumber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class SeriesController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'agent') {
            $subagents = DB::table('subagents')->select('subagent_id')->where('agent_id', Auth::user()->id);

            $agents = DB::table('users')
                ->whereIn('id', $subagents)
                ->get();

            $agents = collect($agents)->map(function (Object $agent) {
                $agent->series_count = 0;
                return $agent;
            });

            return view('series.assigned', [
                'agents' => $agents,
            ]);
        }

        $serieses = CocSeries::latest()->get();

        return view('series.index', [
            'serieses' => $serieses,
        ]);
    }

    public function show($id)
    {
        $series = CocSeries::find($id);

        return view('series.show', [
            'series' => $series
        ]);
    }

    public function owned()
    {
        $series_numbers =
            DB::table('coc_series_numbers')
                ->where('agent_id', Auth::user()->id)
                ->get();

        $subagents =
            DB::table('subagents')
                ->select('subagent_id')
                ->where('agent_id', Auth::user()->id);
        $agents =
            DB::table('users')
                ->whereIn('id', $subagents)
                ->get();

        $assoc_agents = [];

        foreach($agents as $agent) {
            $assoc_agents[$agent->id] = $agent;
        }

        return view('series.owned', [
            'agents' => $assoc_agents,
            'series_numbers' => $series_numbers
        ]);
    }

    public function create()
    {
        if(Auth::user()->role=='agent') {
            $series_numbers =
                DB::table('coc_series_numbers')
                    ->where('agent_id', Auth::user()->id)
                    ->where('status', 'Available')
                    ->get();

            $subagents =
                DB::table('subagents')
                    ->select('subagent_id')
                    ->where('agent_id', Auth::user()->id);
            $agents =
                DB::table('users')
                    ->whereIn('id', $subagents)
                    ->get();

            return view('series.allocate', [
                'agents' => $agents,
                'series_numbers' => $series_numbers,
            ]);
        } else {
            $agents =
            User::where('status','active')
                ->where('role', 'agent')
                ->get();

            return view('series.create', [
                'agents' => $agents,
            ]);
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->role=='agent') {
            $request->validate([
                'subagent_id' => ['required'],
                'series_number' => ['required'],
            ]);

            $subagent = User::findOrFail($request->input('subagent_id'));

            DB::table('coc_series_numbers')
                ->whereIn('id', $request->input('series_number'))
                ->update([
                    'status' => 'assigned',
                    'subagent_id' => $request->input('subagent_id')
                ]);

            return redirect('/series/create')->with([
                'message' => "Successfully assigned series numbers to subagent $subagent->first_name $subagent->last_name."
            ]);
        }

        $agent_id = $request->input('agent_id');
        $agent = User::findOrFail($agent_id);

        $request->merge([
            'start' => preg_replace('/\D/', '', $request->input('start')),
            'end'   => preg_replace('/\D/', '', $request->input('end')),
        ]);

        $seriesAttributes = $request->validate([
            'agent_id' => ['required'],
            'prefix'   => ['nullable'],
            'suffix'   => ['nullable'],
            'start'    => ['integer', 'min:1'],
            'end'      => ['integer', 'min:1'],
        ]);

        if($seriesAttributes['start'] >= $seriesAttributes['end']) {
            throw ValidationException::withMessages([
                'start' => "Series from must not be greater than or equal to Series to",
            ]);
        }
        $difference = $seriesAttributes['end'] - $seriesAttributes['start'];

        if($difference > 10000) {
            throw ValidationException::withMessages([
                'end' => "Series range must not be greater than the maximum limit of 10000",
            ]);
        }

        $series = CocSeries::create($seriesAttributes);
        $data = [];
        for($i=$seriesAttributes['start']; $i<=$seriesAttributes['end']; $i++) {
            $data[] = [
                'series_id'     => $series->id,
                'agent_id'      => $agent_id,
                'number'        => $i,
                'series_number' => ($seriesAttributes['prefix'] ?? '') . $i . ($seriesAttributes['suffix'] ?? ''),
                'status'        => 'available',
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_at'    => Carbon::now()->toDateTimeString(),
            ];
        }

        CocSeriesNumber::insert($data);
        $range = $seriesAttributes['start']. ' - ' . $seriesAttributes['end'];

        return redirect('/series/create')->with([
            'message' => "Successfully assigned series $range to $agent->first_name $agent->last_name."
        ]);
    }
}
