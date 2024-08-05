<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();

        return view('clients.index', [
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show($id)
    {
        $client = Client::find($id);

        return view('clients.show', [
            'client' => $client
        ]);
    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('clients.edit', [
            'client' => $client
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'suffix' => ['nullable'],
            'gender' => ['required', Rule::in(['MALE', 'FEMALE'])],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'email', 'unique:users,email'],
            'mobile_number' => ['required'],
            'tin_number' => ['nullable'],
            'business' => ['nullable'],
            'profession' => ['nullable'],
            'province' => ['required'],
            'city' => ['required'],
            'address' => ['nullable'],
        ]);

        $client = Client::create($attributes);

        return redirect('/clients/create')
            ->with([
                'message' => 'Successfully added ' . $attributes['first_name'] . ' ' . $attributes['last_name'] . '.',
                'url' => "/clients/$client->id",
            ]);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'suffix' => ['nullable'],
            'gender' => ['required', Rule::in(['MALE', 'FEMALE'])],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'email', 'unique:users,email'],
            'mobile_number' => ['required'],
            'tin_number' => ['nullable'],
            'business' => ['nullable'],
            'profession' => ['nullable'],
            'province' => ['required'],
            'city' => ['required'],
            'address' => ['nullable'],
        ]);

        $client = Client::findOrFail($id);
        $client->update($attributes);

        return redirect('/clients/' . $client->id)
            ->with([
                'message' => 'Successfully updated ' . $client['first_name'] . ' ' . $client['last_name'] . '.',
            ]);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('/clients')
            ->with([
                'message' => 'Successfully deleted ' . $client['first_name'] . ' ' . $client['last_name'] . '.',
            ]);
    }

}
