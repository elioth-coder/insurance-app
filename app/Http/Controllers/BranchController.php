<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::where('agent_id', Auth::user()->id)->get();

        return view('branches.index', [
            'branches' => $branches,
        ]);
    }

    public function create()
    {
        return view('branches.create');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);

        return view('branches.edit', [
            'branch' => $branch
        ]);
    }
    
    public function store(Request $request)
    {
        $branchAttributes = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
        ]);
        $branchAttributes['agent_id'] = Auth::user()->id;

        $branch = Branch::create($branchAttributes);

        return redirect('/branches/create')->with([
            'message' => "Successfully added the branch $branch->name to branches"
        ]);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $rules = [
            'name' => ['required'],
            'address' => ['required'],
        ];

        $branchAttributes = $request->validate($rules);
        $branch->update($branchAttributes);

        return redirect("/branches")->with([
            'message' => "Successfully updated the branch to $branch->name"
        ]);
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect("/branches")
            ->with([
                'message' => 'Successfully deleted the branch ' . $branch->name . '.',
            ]);
    }
}
