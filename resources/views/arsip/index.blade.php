@extends('layouts.app')

@section('title', 'e-Arsip')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        e-Arsip Dokumen
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah arsip --}}
    <div class="mb-4">
        <a href="{{ route('arsip.create') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow transition duration-200">
            + Tambah Arsip
        </a>
    </div>

    {{-- Tabel data arsip --}}
    <div class="bg-gray-300 dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm table-auto">
            <thead class="bg-gray-400 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">📁 Nama Arsip</th>
                    <th class="px-4 py-3 text-left">🏷️ Kategori</th>
                    <th class="px-4 py-3 text-left">📎 File</th>
                    <th class="px-4 py-3 text-left">⚙️ Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-200 divide-y divide-gray-100 dark:divide-gray-700">
                @forelse ($arsips as $arsip)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                        <td class="px-4 py-3">{{ $arsip->nama_file }}</td> {{-- Ubah dari nama_arsip ke nama_file --}}
                        <td class="px-4 py-3">{{ $arsip->kategori ?? 'PDF' }}</td> 
                        <td class="px-4 py-3">
                            <a href="{{ asset('storage/' . $arsip->file_path) }}"
                                target="_blank"
                                class="text-blue-500 hover:text-blue-700 underline transition">
                                Lihat File
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('arsip.edit', $arsip->id) }}"
                                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus arsip ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-800 dark:text-gray-400">
                            Belum ada arsip yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
