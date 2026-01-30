<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Tampilkan daftar arsip.
     */
    public function index()
    {
        $arsips = Arsip::latest()->get();
        return view('arsip.index', compact('arsips'));
    }

    /**
     * Tampilkan form untuk membuat arsip baru.
     */
    public function create()
    {
        return view('arsip.create');
    }

    /**
     * Simpan arsip baru ke database dan storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_arsip' => 'required|string|max:255',
            'kategori'   => 'nullable|string|max:255',
            'file'       => 'required|file|mimes:pdf,doc,docx,xlsx,xls,jpg,png,jpeg|max:5120',
        ]);

        // Simpan file ke folder "storage/app/public/arsip"
        $path = $request->file('file')->store('arsip', 'public');

        // Simpan ke database
        Arsip::create([
            'nama_file' => $request->nama_arsip,
            'deskripsi' => $request->kategori,
            'file_path' => $path,
        ]);

        return redirect()->route('arsip.index')->with('success', 'File berhasil diarsipkan.');
    }

    /**
     * Tampilkan detail arsip tertentu.
     */
    public function show(Arsip $arsip)
    {
        return view('arsip.show', compact('arsip'));
    }

    /**
     * Tampilkan form edit arsip.
     */
    public function edit(Arsip $arsip)
    {
        return view('arsip.edit', compact('arsip'));
    }

    /**
     * Perbarui data arsip dan file jika ada.
     */
    public function update(Request $request, Arsip $arsip)
    {
        $request->validate([
            'nama_arsip' => 'required|string|max:255',
            'kategori'   => 'nullable|string|max:255',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,jpg,png,jpeg|max:5120',
        ]);

        $data = [
            'nama_file' => $request->nama_arsip,
            'deskripsi' => $request->kategori,
        ];

        // Jika upload file baru, hapus file lama dan simpan yang baru
        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($arsip->file_path)) {
                Storage::disk('public')->delete($arsip->file_path);
            }

            $data['file_path'] = $request->file('file')->store('arsip', 'public');
        }

        $arsip->update($data);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    /**
     * Hapus arsip dari database dan storage.
     */
    public function destroy(Arsip $arsip)
    {
        if (Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }
}
