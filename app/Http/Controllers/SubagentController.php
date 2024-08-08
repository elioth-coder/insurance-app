<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SubagentController extends Controller
{

    public function lock($id) {
        $user = User::findOrFail($id);

        $user->update(['status' => 'inactive']);
        return redirect("/subagents/")->with([
            'message' => "Successfully locked the account of $user->first_name $user->last_name."
        ]);
    }

    public function unlock($id) {
        $user = User::findOrFail($id);

        $user->update(['status' => 'active']);
        return redirect("/subagents/")->with([
            'message' => "Successfully unlocked the account of $user->first_name $user->last_name."
        ]);
    }

    public function index()
    {
        $subagents = User::where('role', 'subagent')->latest()->get();

        return view('subagents.index', [
            'subagents' => $subagents,
        ]);
    }

    public function edit($id)
    {
        $subagent = User::find($id);

        return view('subagents.edit', [
            'subagent' => $subagent
        ]);
    }

    public function create()
    {
        return view('subagents.create');
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

        $userAttributes['role'] = 'subagent';
        $user = User::create($userAttributes);

        return redirect('/subagents/create')->with([
            'message' => "Successfully registered $user->first_name $user->last_name as a subagent."
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

        return redirect("/subagents/")->with([
            'message' => "Successfully updated details of $user->first_name $user->last_name."
        ]);
    }
}
