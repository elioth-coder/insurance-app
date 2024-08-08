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

    public function print($id) {
        $authentication = Authentication::findOrFail($id);
        $series_number = CocSeriesNumber::where('series_number', $authentication->coc_number)->first();

        // dd($series_number);

        return view('authentication.print', [
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
        $seriesNumbers =
            DB::table('coc_series_numbers')
                ->where('agent_id', Auth::user()->id)
                ->where('status','available')
                ->get();

        return view('authentication.create', [
            'seriesNumbers' => $seriesNumbers,
        ]);
    }

    public function store(Request $request)
    {
        $authenticationAttributes = $request->validate([
            'type' => ['required'],
            // plate_number
            // mv_file_number
            'serial_number' => ['required'],
            // engine_number
            // assured_tin
            'assured_name' => ['required'],
            'assured_address' => ['required'],
            // contact_number
            'email_address' => ['email'],
            'or_number' => ['required'],
            'coc_number' => ['required'],
            'policy_number' => ['required'],
            'vehicle_type' => ['required'],
            'lto_mv_type' => ['required'],
            'inception_date' => ['required','date'],
            'expiry_date' => ['required','date'],
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
