<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Authentication;
use App\Models\CocSeriesNumber;
use App\Models\SerialNumber;
use App\Models\VehicleType;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\OrNumberGenerator;
use Exception;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthenticationController extends Controller
{
    protected $orNumberGenerator;

    public function __construct(OrNumberGenerator $orNumberGenerator)
    {
        $this->orNumberGenerator = $orNumberGenerator;
    }

    public function print($id)
    {
        $authentication = Authentication::findOrFail($id);
        $vehicle_type = VehicleType::where('code', $authentication->vehicle_type)->first();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('authentication.print', [
            'authentication' => $authentication,
            'settings' => $settings,
            'vehicle_type' => $vehicle_type,
        ]);
    }

    public function view($id)
    {
        $authentication = Authentication::findOrFail($id);
        $vehicle_type = VehicleType::where('code', $authentication->vehicle_type)->first();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('authentication.view', [
            'authentication' => $authentication,
            'settings' => $settings,
            'vehicle_type' => $vehicle_type,
        ]);
    }

    public function index()
    {
        $authentications =
            Authentication::where('agent_id', Auth::user()->id)
            ->get();

        return view('authentication.index', [
            'authentications' => $authentications,
        ]);
    }

    public function claim()
    {
        return view('authentication.claim');
    }

    public function verify()
    {
        return view('authentication.verify');
    }

    public function void()
    {
        return view('authentication.void');
    }

    public function create()
    {
        $vehicle_types = VehicleType::all()->sortBy('code');

        return view('authentication.create', [
            'vehicle_types' => $vehicle_types,
        ]);
    }

    public function store(Request $request)
    {
        $serial_number = SerialNumber::where('serial', $request->input('coc_number'))->first();

        if (!$serial_number) {
            throw ValidationException::withMessages([
                'coc_number' => "Invalid serial! Serial number does not exist",
            ]);
        }

        if ($serial_number->status != 'Available') {
            throw ValidationException::withMessages([
                'coc_number' => "Serial number is '$serial_number->status' and can't be used for authentication",
            ]);
        }

        $authenticationAttributes = $request->validate([
            'plate_number'    => ['required'],
            'mv_file_number'  => ['required'],
            'serial_number'   => ['required'],
            'engine_number'   => ['required'],
            'model'           => ['required'],
            'year'            => ['required'],
            'make'            => ['required'],
            'color'           => ['required'],
            'assured_tin'     => ['required'],
            'assured_name'    => ['required'],
            'assured_address' => ['required'],
            'contact_number'  => ['required'],
            'email_address'   => ['required','email'],
            'coc_number'      => ['required'],
            'vehicle_type'    => ['required'],
            'coverage'        => ['required'],
            'inception_date'  => ['required', 'date'],
        ]);

        $coverage = $request->input('coverage');
        $inception_date = $request->input('inception_date');
        $date = Carbon::createFromFormat('Y-m-d', $inception_date);
        $date->addYears((int)$coverage);
        $vehicle_type = VehicleType::where('code', $request->input('vehicle_type'))->first();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        $agent = Auth::user();
        $basic_premium = ($coverage == '1') ? $vehicle_type->one_year : $vehicle_type->three_years;

        $authenticationAttributes['basic_premium']   = $basic_premium;
        $authenticationAttributes['doc_stamp_tax']   = $basic_premium * ($settings['DOC_STAMP_TAX']/100);
        $authenticationAttributes['local_gov_tax']   = $basic_premium * ($settings['LOCAL_GOV_TAX']/100);
        $authenticationAttributes['e_vat']           = $basic_premium * ($settings['E_VAT']/100);
        $authenticationAttributes['pira_fee']        = $settings['PIRA_AUTH_FEE'];
        $authenticationAttributes['net_amount']      = $basic_premium - ($authenticationAttributes['pira_fee'] + $authenticationAttributes['e_vat'] + $authenticationAttributes['local_gov_tax'] + $authenticationAttributes['doc_stamp_tax']);
        $authenticationAttributes['transaction_fee'] = $settings['TRANSACTION_FEE'];
        $authenticationAttributes['oicp_fee']        = $settings['OICP_AUTH_FEE'];
        $authenticationAttributes['amount_due']      = $basic_premium + $settings['TRANSACTION_FEE'] + $settings['OICP_AUTH_FEE'];
        $authenticationAttributes['or_number']       = $this->orNumberGenerator->generate(str_pad(Auth::user()->branch_id.'', 6, '0', STR_PAD_LEFT));
        $authenticationAttributes['expiry_date']     = $date->format('Y-m-d');
        $authenticationAttributes['agent_id']        = $agent->id;
        $authenticationAttributes['policy_number']   = DB::raw('UPPER(UUID())');

        $serial = $authenticationAttributes['coc_number'];
        $authentication = Authentication::create($authenticationAttributes);
        SerialNumber::where('serial', $serial)
            ->update([
                'status' => 'For Verification',
                'agent_id' => $agent->id,
            ]);

        return redirect('/authentication/create')->with([
            'id' => $authentication->id,
            'message' => "Successfully saved authentication for $authentication->assured_name."
        ]);
    }

    public function authenticate(Request $request)
    {
        $agent =
            DB::table('users')
            ->where('email', $request->input('email'))
            // ->where('password', Hash::make($request->input('password')))
            ->first();

        try {
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

            $authenticationAttributes['upload_rate'] = $agent->upload_rate;
            $authenticationAttributes['agent_id'] = $agent->id;
            $coc_number = $authenticationAttributes['coc_number'];
            $authentication = Authentication::create($authenticationAttributes);
            CocSeriesNumber::where('series_number', $coc_number)
                ->update([
                    'status' => 'used',
                    'used_date' => Carbon::now()->format('d-m-Y')
                ]);

            return response()->json([
                'status' => 'success',
                'message' => "Successfully saved registration for $authentication->assured_name."
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => "Errors were encountered during request.",
                'errors'  => $e->validator->errors(),
            ]);
        }
    }

    public function check_serial(Request $request)
    {
        try {
            $serial = SerialNumber::where('serial', $request->input('serial'))->first();

            if (!$serial) {
                throw new Exception("Serial number does not exist");
            }

            return response()->json([
                'status' => 'success',
                'serial' => $serial,
            ]);

        } catch (Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function verify_serial(Request $request)
    {
        try {
            $serial = SerialNumber::where('serial', $request->input('serial'))->first();

            if (!$serial) {
                throw new Exception("Serial number does not exist");
            }
            if ($serial->status == 'Verified') {
                throw new Exception("Serial number already 'Verified'");
            }
            if ($serial->status != 'For Verification') {
                throw new Exception("Serial number is not 'For Verification'");
            }

            $serial->update([
                'status' => 'Verified',
                'agent_id' => Auth::user()->id,
            ]);

            return response()->json([
                'status'  => 'success',
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function void_serial(Request $request)
    {
        try {
            $serial = SerialNumber::where('serial', $request->input('serial'))->first();

            if (!$serial) {
                throw new Exception("Serial number does not exist");
            }
            if ($serial->status == 'Voided') {
                throw new Exception("Serial number already 'Voided'");
            }

            $serial->update([
                'status' => 'Voided',
                'agent_id' => Auth::user()->id,
            ]);

            return response()->json([
                'status'  => 'success',
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function vehicle(Request $request)
    {
        $criteria = request()->input('criteria');
        $authentication = Authentication::where($criteria, $request->input($criteria))->latest()->first();

        return response()->json([
            'authentication' => $authentication,
        ]);
    }

}
