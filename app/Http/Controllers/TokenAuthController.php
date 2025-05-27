<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingToken;
use Illuminate\Support\Facades\Auth;

class TokenAuthController extends Controller
{
    public function showTokenForm()
    {
        return view('voting.token-login');
    }

    public function processTokenLogin(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $token = VotingToken::where('token', $request->token)
            ->where('used', false)
            ->first();

        if (!$token) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah digunakan']);
        }

        // Simpan token di session
        session(['voting_token' => $token->token]);

        // Redirect ke halaman voting
        return redirect()->route('voting');
    }

    public function logout()
    {
        // Dapatkan token dari session
        $tokenValue = session('voting_token');

        if ($tokenValue) {
            // Update token menjadi used
            VotingToken::where('token', $tokenValue)
                ->update([
                    'used' => true,
                    'used_at' => now()
                ]);
        }

        // Hapus session
        session()->forget('voting_token');

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
