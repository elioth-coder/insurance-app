<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicle_types = VehicleType::all();

        return view('vehicle_types.index', [
            'vehicle_types' => $vehicle_types,
        ]);
    }

    public function edit($id)
    {
        $vehicle_type = VehicleType::findOrFail($id);

        return view('vehicle_types.edit', [
            'vehicle_type' => $vehicle_type
        ]);
    }

    public function create()
    {
        return view('vehicle_types.create');
    }

    public function store(Request $request)
    {
        $vehicleTypeAttributes = $request->validate([
            'code' => ['required','max:5'],
            'type' => ['required'],
            'one_year' => ['required','numeric'],
            'three_years' => ['required','numeric'],
        ]);

        $vehicle_type = VehicleType::create($vehicleTypeAttributes);

        return redirect('settings/vehicle_types/create')->with([
            'message' => "Successfully added $vehicle_type->type to vehicle types"
        ]);
    }

    public function update(Request $request, $id)
    {
        $vehicle_type = VehicleType::findOrFail($id);

        $vehicleTypeAttributes = $request->validate([
            'code' => ['required','max:5'],
            'type' => ['required'],
            'one_year' => ['required','numeric'],
            'three_years' => ['required','numeric'],
        ]);

        $vehicle_type->update($vehicleTypeAttributes);

        return redirect("settings/vehicle_types")->with([
            'message' => "Successfully updated a vehicle type to $vehicle_type->type"
        ]);
    }

    public function destroy($id)
    {
        $vehicle_type = VehicleType::findOrFail($id);
        $vehicle_type->delete();

        return redirect("settings/vehicle_types")
            ->with([
                'message' => 'Successfully deleted the vehicle type ' . $vehicle_type->type . '.',
            ]);
    }
}
