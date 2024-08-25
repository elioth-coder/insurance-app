<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Authentication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    private function getAuthentications()
    {
        $subagents = DB::table('subagents')->select('subagent_id')->where('agent_id', Auth::user()->id);
        $agents = User::whereIn('id', $subagents)->get();
        $authentications =
            Authentication::whereIn('agent_id', $subagents)
            ->get();

        $authentications = $authentications->map(function (Object $authentication) use ($agents) {
            $authentication->agent = $agents->filter(function (Object $agent, int $key) use ($authentication) {
                return $agent->id == $authentication->agent_id;
            })->first();

            return $authentication;
        });

        return $authentications;
    }

    public function authentications()
    {
        $authentications = $this->getAuthentications();

        return view('reports.authentications', [
            'authentications' => $authentications,
        ]);
    }

    public function print_authentications()
    {
        $authentications = $this->getAuthentications();

        return view('reports.print-authentications', [
            'authentications' => $authentications,
        ]);
    }

    private function getPerAgentAuthentications()
    {
        $subagents = DB::table('subagents')->select('subagent_id')->where('agent_id', Auth::user()->id);
        $agents = User::whereIn('id', $subagents)->get();

        $authentications = Authentication::select('agent_id', 'upload_rate', DB::raw('COUNT(id) as quantity'))
            ->whereIn('agent_id', function ($query) {
                $query->select('subagent_id')
                    ->from('subagents')
                    ->where('agent_id', Auth::user()->id);
            })
            ->groupBy('agent_id','upload_rate')
            ->get();

        $authentications = collect($authentications)->map(function (Object $authentication) use ($agents) {
            $authentication->agent = $agents->filter(function (Object $agent, int $key) use ($authentication) {
                return $agent->id == $authentication->agent_id;
            })->first();
            $authentication->subtotal = $authentication->quantity * $authentication->upload_rate;

            return $authentication;
        });

        return $authentications;
    }

    public function agents()
    {
        $authentications = $this->getPerAgentAuthentications();

        return view('reports.agents', [
            'authentications' => $authentications,
        ]);
    }

    public function print_agents()
    {
        $authentications = $this->getPerAgentAuthentications();

        return view('reports.print-agents', [
            'authentications' => $authentications,
        ]);
    }
}
