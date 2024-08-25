<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CocSeriesNumber;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $results =
            DB::table('authentications')
            ->where('coc_number', $request->input('query'))
            ->orWhere('plate_number', $request->input('query'))
            ->orWhere('mv_file_number', $request->input('query'))
            ->latest()
                ->get();

        if(count($results) > 0) {
            $authentication = $results[0];
            $series_number = CocSeriesNumber::where('series_number', $authentication->coc_number)->first();

            return view('search.index', [
                'results' => $results,
                'authentication' => $authentication,
                'series_number' => $series_number,
            ]);
        }

        return view('search.index', [
            'results' => $results,
        ]);
    }
}
