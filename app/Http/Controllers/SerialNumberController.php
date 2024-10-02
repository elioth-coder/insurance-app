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

    public function store(Request $request)
    {
        $quantity = $request->input('quantity');

        for($i=0; $i<$quantity; $i++) {
            SerialNumber::create([
                'serial'   => DB::raw('UPPER(UUID())'),
                'status'   => 'Available',
                'agent_id' => Auth::user()->id,
            ]);
        }

        return redirect('/serial_numbers/create')->with([
            'message' => "Successfully generated $quantity serial numbers"
        ]);
    }
}
