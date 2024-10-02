<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::all();

        return view('domains.index', [
            'domains' => $domains,
        ]);
    }

    public function create()
    {
        return view('domains.create');
    }

    public function edit($id)
    {
        $domain = Domain::findOrFail($id);

        return view('domains.edit', [
            'domain' => $domain
        ]);
    }
    public function store(Request $request)
    {
        $domainAttributes = $request->validate([
            'name' => ['required'],
            'host' => ['required'],
        ]);

        $domain = Domain::create($domainAttributes);

        return redirect('/settings/domains/create')->with([
            'message' => "Successfully added $domain->host to external domains"
        ]);
    }

    public function update(Request $request, $id)
    {
        $domain = Domain::findOrFail($id);

        $domainAttributes = $request->validate([
            'name' => ['required'],
            'host' => ['required'],
        ]);

        $domain->update($domainAttributes);

        return redirect("/settings/domains")->with([
            'message' => "Successfully updated domain to $domain->host"
        ]);
    }

    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $domain->delete();

        return redirect("/settings/domains")
            ->with([
                'message' => 'Successfully deleted the domain ' . $domain->host . '.',
            ]);
    }
}
