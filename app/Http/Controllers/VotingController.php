<?php

namespace App\Http\Controllers;

use App\Models\Paslon;
use App\Models\VotingToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    public function checkToken(Request $request)
    {
        $token = session('voting_token');

        // Jika tidak ada token di session, redirect ke login
        if (!$token) {
            return redirect()->route('token.login')
                   ->with('error', 'Anda harus login terlebih dahulu');
        }

        // Cek validitas token
        $validToken = VotingToken::where('token', $token)
                      ->where('used', false)
                      ->exists();

        if (!$validToken) {
            session()->forget('voting_token');
            return redirect()->route('token.login')
                   ->with('error', 'Token tidak valid atau sudah digunakan');
        }

        // Jika valid, tampilkan halaman voting
        $paslons = Paslon::all();
        return view('voting.index', compact('paslons'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'paslon_id' => 'required|exists:paslon,id'
    ]);

    // Dapatkan token dari session
    $tokenValue = session('voting_token');

    // Update token voting
    VotingToken::where('token', $tokenValue)
        ->update([
            'paslon_id' => $request->paslon_id,
            'used' => true,
            'used_at' => now()
        ]);

    // Tambahkan jumlah pemilih pada paslon terkait
    DB::table('paslon')
        ->where('id', $request->paslon_id)
        ->increment('total_pemilih');

    // Hapus session
    session()->forget('voting_token');

    return redirect('/token-login')
           ->with('success', 'Terima kasih, voting Anda telah direkam!');
}

}
