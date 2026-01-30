<?php

namespace App\Http\Controllers;

use App\Models\Notulen;
use Illuminate\Http\Request;

class NotulenController extends Controller
{
    /**
     * Tampilkan daftar semua notulen.
     */
    public function index()
    {
        $notulens = Notulen::latest()->get();
        return view('notulen.index', compact('notulens'));
    }

    /**
     * Tampilkan form tambah notulen baru.
     */
    public function create()
    {
        return view('notulen.create');
    }

    /**
     * Simpan notulen baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_rapat'     => 'required|string|max:255',
            'tanggal_rapat'   => 'required|date',
            'waktu_mulai'     => 'required',
            'waktu_selesai'   => 'required',
            'tempat'          => 'required|string|max:255',
            'pembicara'       => 'required|string|max:255',
            'isi_notulen'     => 'required|string',
        ]);

        Notulen::create($validated);

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail notulen tertentu.
     */
    public function show($id)
    {
        $notulen = Notulen::findOrFail($id);
        return view('notulen.show', compact('notulen'));
    }

    /**
     * Tampilkan form edit notulen.
     */
    public function edit(Notulen $notulen)
    {
        return view('notulen.edit', compact('notulen'));
    }

    /**
     * Update notulen yang sudah ada.
     */
    public function update(Request $request, Notulen $notulen)
    {
        $validated = $request->validate([
            'judul_rapat'     => 'required|string|max:255',
            'tanggal_rapat'   => 'required|date',
            'waktu_mulai'     => 'required',
            'waktu_selesai'   => 'required',
            'tempat'          => 'required|string|max:255',
            'pembicara'       => 'required|string|max:255',
            'isi_notulen'     => 'required|string',
        ]);

        $notulen->update($validated);

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil diperbarui.');
    }

    /**
     * Hapus notulen dari database.
     */
    public function destroy(Notulen $notulen)
    {
        $notulen->delete();

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil dihapus.');
    }
}
