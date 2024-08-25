<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Authentication;
use App\Models\CocSeriesNumber;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthenticationController extends Controller
{
    public function claim($report_number)
    {
        return view('authentication.claim', [
            'report_number' => $report_number,
        ])->with(['success' => 'Successfully claimed insurance.']);
    }

    public function print($id)
    {
        $authentication = Authentication::findOrFail($id);
        $series_number = CocSeriesNumber::where('series_number', $authentication->coc_number)->first();

        return view('authentication.print', [
            'authentication' => $authentication,
            'series_number' => $series_number,
        ]);
    }

    public function view($id)
    {
        $authentication = Authentication::findOrFail($id);
        $series_number = CocSeriesNumber::where('series_number', $authentication->coc_number)->first();

        return view('authentication.view', [
            'authentication' => $authentication,
            'series_number' => $series_number,
        ]);
    }

    public function index()
    {
        $authentications = Authentication::all();

        return view('authentication.index', [
            'authentications' => $authentications,
        ]);
    }

    public function create()
    {
        if (Auth::user()->role == 'subagent') {
            $seriesNumbers =
                DB::table('coc_series_numbers')
                ->where('subagent_id', Auth::user()->id)
                ->where('status', 'assigned')
                ->get();
        } else {
            $seriesNumbers =
                DB::table('coc_series_numbers')
                ->where('agent_id', Auth::user()->id)
                ->where('status', 'available')
                ->get();
        }

        return view('authentication.create', [
            'seriesNumbers' => $seriesNumbers,
        ]);
    }

    public function store(Request $request)
    {
        $authenticationAttributes = $request->validate([
            'type' => ['required'],
            'plate_number' => ['string'],
            'mv_file_number' => ['required'],
            'serial_number' => ['required'],
            'engine_number' => ['string'],
            'assured_tin' => ['string'],
            'assured_name' => ['required'],
            'assured_address' => ['required'],
            'contact_number' => ['string'],
            'email_address' => ['email'],
            'or_number' => ['required'],
            'coc_number' => ['required'],
            'policy_number' => ['required'],
            'vehicle_type' => ['required'],
            'lto_mv_type' => ['required'],
            'inception_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ]);

        $coc_number = $authenticationAttributes['coc_number'];
        $authentication = Authentication::create($authenticationAttributes);
        CocSeriesNumber::where('series_number', $coc_number)
            ->update([
                'status' => 'used',
                'used_date' => Carbon::now()->format('d-m-Y')
            ]);

        return redirect('/authentication/create')->with([
            'message' => "Successfully saved registration for $authentication->assured_name."
        ]);
    }
}
