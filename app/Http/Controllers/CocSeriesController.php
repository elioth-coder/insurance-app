<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CocSeries;
use App\Models\CocSeriesNumber;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class CocSeriesController extends Controller
{
    public function index()
    {
        $serieses = CocSeries::latest()->get();

        return view('coc_series.index', [
            'serieses' => $serieses,
        ]);
    }

    public function show($id)
    {
        $series = CocSeries::find($id);

        return view('coc_series.show', [
            'series' => $series
        ]);
    }

    public function create()
    {
        $agents = User::where('status','active')->get();

        return view('coc_series.create', [
            'agents' => $agents,
        ]);
    }

    public function store(Request $request)
    {
        $agent_id = $request->input('agent_id');
        $agent = User::findOrFail($agent_id);

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

        return redirect('/coc_series/create')->with([
            'message' => "Successfully assigned series $range to $agent->first_name $agent->last_name."
        ]);
    }
}
