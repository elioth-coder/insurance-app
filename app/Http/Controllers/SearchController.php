<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\VehicleType;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $authentication =
            DB::table('authentications')
                ->where('coc_number', $request->input('query'))
                ->orWhere('plate_number', $request->input('query'))
                ->orWhere('mv_file_number', $request->input('query'))
                ->latest()
                ->first();

        if($authentication) {
            $agent = User::where('id', $authentication->agent_id);
            $vehicle_type = VehicleType::where('code', $authentication->vehicle_type)->first();
            $allSettings = Setting::all();
            $settings = [];

            foreach($allSettings as $setting) {
                $settings[$setting->key] = $setting->value;
            }

            return view('search.index', [
                'authentication' => $authentication,
                'settings' => $settings,
                'vehicle_type' => $vehicle_type,
                'agent' => $agent,
            ]);
        }

        return view('search.index', [
            'results' => [],
        ]);
    }
}
