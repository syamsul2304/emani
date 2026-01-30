@extends('layouts.app')

@section('title', 'Edit Notulen')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-green-200 leading-tight">
        Edit 
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit --}}
        <form action="{{ route('notulen.update', $notulen->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="judul_rapat" class="block font-medium text-gray-700 dark:text-gray-200">Judul Rapat</label>
                <input type="text" name="judul_rapat" id="judul_rapat"
                    value="{{ old('judul_rapat', $notulen->judul_rapat) }}"
                    class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
            </div>

            <div>
                <label for="tanggal_rapat" class="block font-medium text-gray-700 dark:text-gray-200">Tanggal Rapat</label>
                <input type="date" name="tanggal_rapat" id="tanggal_rapat"
                    value="{{ old('tanggal_rapat', $notulen->tanggal_rapat) }}"
                    class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="waktu_mulai" class="block font-medium text-gray-700 dark:text-white">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai"
                        value="{{ old('waktu_mulai', $notulen->waktu_mulai) }}"
                        class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                </div>
                <div>
                    <label for="waktu_selesai" class="block font-medium text-gray-700 dark:text-gray-200">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai"
                        value="{{ old('waktu_selesai', $notulen->waktu_selesai) }}"
                        class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
                </div>
            </div>

            <div>
                <label for="tempat" class="block font-medium text-gray-700 dark:text-gray-200">Tempat</label>
                <input type="text" name="tempat" id="tempat"
                    value="{{ old('tempat', $notulen->tempat) }}"
                    class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
            </div>

            <div>
                <label for="pembicara" class="block font-medium text-gray-700 dark:text-gray-200">Pembicara / Notulis</label>
                <input type="text" name="pembicara" id="pembicara"
                    value="{{ old('pembicara', $notulen->pembicara) }}"
                    class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>
            </div>

            <div>
                <label for="isi_notulen" class="block font-medium text-gray-700 dark:text-gray-200">Isi Notulen</label>
                <textarea name="isi_notulen" id="isi_notulen" rows="6"
                    class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded" required>{{ old('isi_notulen', $notulen->isi_notulen) }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('notulen.index') }}"
                   class="mr-4 px-4 py-2 rounded bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-700">Batal</a>
                <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
