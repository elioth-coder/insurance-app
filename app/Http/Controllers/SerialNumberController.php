<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SerialNumber;

class SerialNumberController extends Controller
{
    public function index()
    {
        $serial_numbers = SerialNumber::all();

        return view('serial_numbers.index', [
            'serial_numbers' => $serial_numbers,
        ]);
    }

    public function create()
    {
        return view('serial_numbers.create');
    }


    public function print(Request $request)
    {
        $serials = explode(',', $request->input('serials'));
        return view('serial_numbers.print',[
            'serials' => $serials
        ]);
    }

    public function store(Request $request)
    {
        $quantity = $request->input('quantity');
        $serials  = [];

        for($i=0; $i<$quantity; $i++) {
            $data = SerialNumber::create([
                'serial'   => DB::raw('UUID_SHORT()'),
                'status'   => 'Available',
                'agent_id' => Auth::user()->id,
            ]);

            $serial    = SerialNumber::findOrFail($data->id);
            $serials[] = $serial->serial;
        }

        return redirect('/serial_numbers/create')->with([
            'serials' => json_encode($serials),
            'message' => "Successfully generated $quantity serial numbers"
        ]);
    }
}
