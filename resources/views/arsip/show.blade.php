@extends('layouts.app')

@section('title', 'Detail Arsip')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Detail e-Arsip Dokumen
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">

    {{-- Notifikasi sukses (jika ada) --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">📁 Nama Arsip</label>
            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                {{ $arsip->nama_arsip }}
            </p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">🏷️ Kategori</label>
            <p class="mt-1 text-gray-800 dark:text-gray-200">
                {{ $arsip->kategori ?? '-' }}
            </p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">📎 File Arsip</label>
            <a href="{{ asset('storage/' . $arsip->file_path) }}" target="_blank"
               class="mt-1 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                Lihat / Unduh File
            </a>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('arsip.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow transition">
                ← Kembali
            </a>

            <div class="flex space-x-2">
                <a href="{{ route('arsip.edit', $arsip) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow">
                    ✏️ Edit
                </a>

                <form action="{{ route('arsip.destroy', $arsip) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus arsip ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
