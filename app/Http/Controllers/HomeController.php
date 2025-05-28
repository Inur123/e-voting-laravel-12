<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingToken;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $stats = $this->getVotingStats();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($stats);
        }

        return view('welcome', $stats);
    }

    private function getVotingStats()
    {
        $totalTokens = VotingToken::count();
        $usedTokens = VotingToken::where('used', true)->count();
        $unusedTokens = $totalTokens - $usedTokens;
        $percentageUsed = $totalTokens > 0 ? round(($usedTokens / $totalTokens) * 100, 2) : 0;

        return compact('totalTokens', 'usedTokens', 'unusedTokens', 'percentageUsed');
    }
}
