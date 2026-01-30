@extends('layouts.app')

@section('title', 'Tambah Notulen')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Tambah Notulen Rapat
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <form action="{{ route('notulen.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Judul Rapat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Judul Rapat</label>
                <input type="text" name="judul_rapat" value="{{ old('judul_rapat') }}" required
                    class="w-full mt-1 border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white">
                @error('judul_rapat')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Rapat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Rapat</label>
                <input type="date" name="tanggal_rapat" value="{{ old('tanggal_rapat') }}" required
                    class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                @error('tanggal_rapat')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Waktu --}}
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required
                        class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                    @error('waktu_mulai')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required
                        class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                    @error('waktu_selesai')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tempat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tempat</label>
                <input type="text" name="tempat" value="{{ old('tempat') }}" required
                    class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                @error('tempat')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pembicara --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pembicara / Notulis</label>
                <input type="text" name="pembicara" value="{{ old('pembicara') }}" required
                    class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                @error('pembicara')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Notulen --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Isi Notulen</label>
                <textarea name="isi_notulen" rows="6" required
                    class="w-full mt-1 border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">{{ old('isi_notulen') }}</textarea>
                @error('isi_notulen')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="text-right space-x-2">
                <a href="{{ route('notulen.index') }}" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
