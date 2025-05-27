<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaslonController extends Controller
{
    /**
     * Display a listing of paslon.
     */
    public function index()
    {
       $paslons = Paslon::all(); // ambil semua data paslon
    return view('admin.paslon.index', compact('paslons'));

    }

    /**
     * Store a newly created paslon in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_urut' => 'required|integer|unique:paslon,nomor_urut',
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi_misi' => 'required|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('paslon-images', 'public');
        }

        Paslon::create([
            'nomor_urut' => $validated['nomor_urut'],
            'nama' => $validated['nama'],
            'gambar' => $gambarPath,
            'visi_misi' => $validated['visi_misi'],
            'total_pemilih' => 0,
        ]);

        return redirect()->route('admin.paslon.index')->with('success', 'Paslon berhasil ditambahkan.');
    }

    /**
     * Update the specified paslon.
     */
    public function update(Request $request, Paslon $paslon)
    {
        $validated = $request->validate([
            'nomor_urut' => 'required|integer|unique:paslon,nomor_urut,' . $paslon->id,
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'visi_misi' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paslon->gambar && Storage::disk('public')->exists($paslon->gambar)) {
                Storage::disk('public')->delete($paslon->gambar);
            }
            $paslon->gambar = $request->file('gambar')->store('paslon-images', 'public');
        }

        $paslon->update([
            'nomor_urut' => $validated['nomor_urut'],
            'nama' => $validated['nama'],
            'visi_misi' => $validated['visi_misi'],
        ]);

        return redirect()->route('admin.paslon.index')->with('success', 'Paslon berhasil diperbarui.');
    }

    /**
     * Remove the specified paslon.
     */
    public function destroy(Paslon $paslon)
    {
        if ($paslon->gambar && Storage::disk('public')->exists($paslon->gambar)) {
            Storage::disk('public')->delete($paslon->gambar);
        }

        $paslon->delete();

        return redirect()->route('admin.paslon.index')->with('success', 'Paslon berhasil dihapus.');
    }
}
