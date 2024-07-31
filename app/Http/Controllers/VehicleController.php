<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function edit($id, $vehicle_id)
    {
        $client = Client::findOrFail($id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        return view('vehicles.edit', [
            'client' => $client,
            'vehicle' => $vehicle,
        ]);
    }

    public function create($id)
    {
        $client = Client::findOrFail($id);

        return view('vehicles.create', [
            'client' => $client
        ]);
    }

    public function store(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $attributes = $request->validate([
            'plate_number' => ['nullable'],
            'mv_file_number' => ['nullable'],
            'chassis_number' => ['required'],
            'engine_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'color' => ['required'],
            'body_type' => ['required'],
            'unladen_weight' => ['nullable','integer'],
            'load_capacity' => ['nullable','integer'],
        ]);

        $client->vehicles()->create($attributes);

        return redirect("/clients/$id");
    }

    public function update(Request $request, $id, $vehicle_id)
    {
        $client = Client::findOrFail($id);

        $attributes = $request->validate([
            'plate_number' => ['nullable'],
            'mv_file_number' => ['nullable'],
            'chassis_number' => ['required'],
            'engine_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'color' => ['required'],
            'body_type' => ['required'],
            'unladen_weight' => ['nullable','integer'],
            'load_capacity' => ['nullable','integer'],
        ]);

        $client->vehicles()->find($vehicle_id)->update($attributes);

        return redirect("/clients/$id");
    }

    public function destroy($id, $vehicle_id)
    {
        $client = Client::findOrFail($id);
        $vehicle = $client->vehicles()->findOrFail($vehicle_id);

        $vehicle->delete();

        return redirect("/clients/$id");
    }
}
