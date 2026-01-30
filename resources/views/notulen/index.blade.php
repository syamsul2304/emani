@extends('layouts.app')

@section('title', 'Daftar Notulen')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Daftar Jadwal Rapat
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Notifikasi flash message --}}
    @if (session('success') || session('deleted'))
        <div class="mb-4 p-4 rounded text-sm 
            {{ session('success') ? 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100' : 'bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-100' }}">
            {{ session('success') ?? session('deleted') }}
        </div>
    @endif

    {{-- Tombol tambah --}}
    <div class="mb-4">
        <a href="{{ route('notulen.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded shadow">
            + Tambah Jadwal Rapat
        </a>
    </div>

    {{-- Tabel daftar notulen --}}
    <div class="overflow-x-auto bg-gray-300 dark:bg-gray-800 shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200 dark:border-gray-600 text-sm">
            <thead class="bg-gray-400 dark:bg-gray-700 text-left text-gray-900 dark:text-gray-100">
                <tr>
                    <th class="px-4 py-2 border dark:border-gray-600">Judul</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Tanggal</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Waktu</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Tempat</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Pembicara</th>
                    <th class="px-4 py-2 border dark:border-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-200">
                @forelse ($notulens as $notulen)
                    <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $notulen->judul_rapat }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">
                            {{ \Carbon\Carbon::parse($notulen->tanggal_rapat)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $notulen->waktu_mulai }} - {{ $notulen->waktu_selesai }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $notulen->tempat }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $notulen->pembicara }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">
                            <div class="flex flex-col space-y-1">
                                <button 
                                    onclick='showModal(@json($notulen))'
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-center">
                                    Lihat Detail
                                </button>
                                <a href="{{ route('notulen.edit', $notulen->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-center">
                                    Edit
                                </a>
                                <form action="{{ route('notulen.destroy', $notulen->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus notulen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 w-full">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada notulen rapat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Detail Notulen --}}
<div id="notulenModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 w-full max-w-2xl p-6 rounded shadow relative">
        <h3 class="text-xl font-bold mb-4">Detail Notulen</h3>
        <div>
            <p><strong>Judul:</strong> <span id="modalJudul"></span></p>
            <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
            <p><strong>Waktu:</strong> <span id="modalWaktu"></span></p>
            <p><strong>Tempat:</strong> <span id="modalTempat"></span></p>
            <p><strong>Pembicara:</strong> <span id="modalPembicara"></span></p>
            <p><strong>Isi Notulen:</strong> <span id="modalIsi"></span></p>
        </div>
        <button onclick="closeModal()" class="mt-4 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
            Tutup
        </button>
    </div>
</div>

{{-- Script Modal --}}
<script>
    function showModal(data) {
        document.getElementById('modalJudul').innerText = data.judul_rapat || '-';
        document.getElementById('modalTanggal').innerText = new Date(data.tanggal_rapat).toLocaleDateString('id-ID') || '-';
        document.getElementById('modalWaktu').innerText = (data.waktu_mulai || '-') + ' - ' + (data.waktu_selesai || '-');
        document.getElementById('modalTempat').innerText = data.tempat || '-';
        document.getElementById('modalPembicara').innerText = data.pembicara || '-';
        document.getElementById('modalIsi').innerText = data.isi_notulen || 'Tidak ada isi';

        const modal = document.getElementById('notulenModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('notulenModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection
