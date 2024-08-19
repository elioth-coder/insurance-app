<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AgentController extends Controller
{

    public function lock($id) {
        $user = User::findOrFail($id);

        $user->update(['status' => 'inactive']);
        return redirect("/agents/")->with([
            'message' => "Successfully locked the account of $user->first_name $user->last_name."
        ]);
    }

    public function unlock($id) {
        $user = User::findOrFail($id);

        $user->update(['status' => 'active']);
        return redirect("/agents/")->with([
            'message' => "Successfully unlocked the account of $user->first_name $user->last_name."
        ]);
    }

    public function index()
    {
        $agents = User::where('role', 'agent')->latest()->get();

        return view('agents.index', [
            'agents' => $agents,
        ]);
    }

    public function edit($id)
    {
        $agent = User::find($id);

        return view('agents.edit', [
            'agent' => $agent
        ]);
    }

    public function create()
    {
        return view('agents.create');
    }

    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile_number' => ['required','min:11','max:11'],
            'branch' => ['required'],
            'status' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $userAttributes['role'] = 'agent';
        $user = User::create($userAttributes);

        return redirect('/agents/create')->with([
            'message' => "Successfully registered $user->first_name $user->last_name as an agent."
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $userAttributes = $request->validate([
            'mobile_number' => ['required','min:11','max:11'],
            'branch' => ['required'],
            'status' => ['required'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user->update($userAttributes);

        return redirect("/agents/")->with([
            'message' => "Successfully updated details of $user->first_name $user->last_name."
        ]);
    }
}