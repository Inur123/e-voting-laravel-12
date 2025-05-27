<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VotingToken;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = VotingToken::latest()->paginate(20);
        return view('admin.token.index', compact('tokens'));
    }

   public function store(Request $request)
{
    $request->validate([
        'jumlah' => 'required|integer|min:1|max:500',
    ]);

    for ($i = 0; $i < $request->jumlah; $i++) {
        // Generate 6 karakter random alfanumerik uppercase
        $token = strtoupper(Str::random(6));

        VotingToken::create([
            'token' => $token,
        ]);
    }

    return redirect()->route('admin.token.index')->with('success', $request->jumlah . ' token berhasil dibuat.');
}

 public function destroy($id)
{
    $token = VotingToken::findOrFail($id);

    if ($token->used) {
        return back()->with('error', 'Token yang sudah digunakan tidak bisa dihapus.');
    }

    $token->delete();
    return back()->with('success', 'Token berhasil dihapus.');
}

}
