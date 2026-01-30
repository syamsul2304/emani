@extends('layouts.app')

@section('title', 'Detail Notulen')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Detail Notulen Rapat
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-4">

            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Judul Rapat</h3>
                <p class="text-gray-800 dark:text-gray-100">{{ $notulen->judul_rapat }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Tanggal Rapat</h3>
                    <p class="text-gray-800 dark:text-gray-100">{{ \Carbon\Carbon::parse($notulen->tanggal_rapat)->format('d M Y') }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Waktu</h3>
                    <p class="text-gray-800 dark:text-gray-100">{{ $notulen->waktu_mulai }} - {{ $notulen->waktu_selesai }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Tempat</h3>
                    <p class="text-gray-800 dark:text-gray-100">{{ $notulen->tempat }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pembicara / Notulis</h3>
                    <p class="text-gray-800 dark:text-gray-100">{{ $notulen->pembicara }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Isi Notulen</h3>
                <p class="text-gray-800 dark:text-gray-100 whitespace-pre-line">
                    {{ $notulen->isi_notulen }}
                </p>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('notulen.edit', $notulen->id) }}"
                   class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white">
                    ✏️ Edit
                </a>
                <form action="{{ route('notulen.destroy', $notulen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notulen ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                        🗑️ Hapus
                    </button>
                </form>
                <a href="{{ route('notulen.index') }}"
                   class="px-4 py-2 rounded bg-gray-400 hover:bg-gray-500 text-white">
                    ⬅️ Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
