<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\Setting;
use App\Models\VehicleType;

class PrototypeController extends Controller
{
    public function new_application()
    {
        $data = [
            'status' => 'success',
            'message' => 'Your CTPL insurance application has been successfully processed.',
            'data' => [
                'application_id' => 'CTPL123456',
                'policy_number' => 'POL123456789',
                'coc_number' => 'COC987654321',
                'applicant' => [
                    'name' => 'Juan Dela Cruz',
                    'contact_number' => '+63 912 345 6789',
                    'email' => 'juandelacruz@example.com',
                    'id_number' => 'A123456789',
                    'id_type' => 'Driver\'s License'
                ],
                'vehicle' => [
                    'make' => 'Toyota',
                    'model' => 'Vios',
                    'year' => 2022,
                    'plate_number' => 'ABC1234'
                ],
                'insurance_details' => [
                    'coverage_amount' => 100000,
                    'premium' => 500,
                    'start_date' => '2024-11-01',
                    'end_date' => '2025-10-31'
                ],
                'issued_by' => [
                    'company_name' => 'ABC Insurance Corporation',
                    'branch' => 'Makati City Branch',
                    'contact_number' => '(02) 1234-5678'
                ]
            ]
        ];

        return response()->json($data);
    }

    public function print_paper($id)
    {
        $authentication = Authentication::findOrFail($id);
        $vehicle_type = VehicleType::where('code', $authentication->vehicle_type)->first();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('prototype.print_paper', [
            'authentication' => $authentication,
            'settings' => $settings,
            'vehicle_type' => $vehicle_type,
        ]);
    }

    public function qr_verifier()
    {
        return view('prototype.qr_verifier');
    }

    public function verified_qr($id)
    {
        $authentication = Authentication::findOrFail($id);
        $vehicle_type = VehicleType::where('code', $authentication->vehicle_type)->first();
        $allSettings = Setting::all();
        $settings = [];

        foreach($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('prototype.verified_qr', [
            'authentication' => $authentication,
            'settings' => $settings,
            'vehicle_type' => $vehicle_type,
        ]);
    }
}
