@extends('layouts.app')

@section('title', 'Edit Arsip')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Edit e-Arsip Dokumen
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">

    {{-- Error Validasi --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-100 rounded shadow">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Arsip --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <form action="{{ route('arsip.update', $arsip) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Arsip --}}
            <div class="mb-4">
                <label for="nama_arsip" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">
                    Nama Arsip <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_arsip" id="nama_arsip"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm"
                       value="{{ old('nama_arsip', $arsip->nama_arsip) }}" required>
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">
                    Kategori Arsip
                </label>
                <input type="text" name="kategori" id="kategori"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm"
                       value="{{ old('kategori', $arsip->kategori) }}">
            </div>

            {{-- Upload File Baru (Opsional) --}}
            <div class="mb-4">
                <label for="file_path" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">
                    Upload File Baru (Opsional)
                </label>
                <input type="file" name="file_path" id="file_path"
                       accept=".pdf,.doc,.docx,.xlsx,.jpg,.png"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm">
                <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('arsip.index') }}"
                   class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow transition">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                    Update Arsip
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
