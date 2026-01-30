@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Dashboard
    </h2>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6 space-y-10">

    {{-- Sapaan --}}
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
        Selamat Datang, {{ Auth::user()->name }}
    </h1>

    {{-- Grafik Per Bulan --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 p-6 rounded-xl shadow-sm dark:shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
            📊 Grafik Notulen & Arsip per Bulan ({{ date('Y') }})
        </h3>
        <div class="h-64 w-full max-w-3xl mx-auto"> {{-- ukuran lebih kecil --}}
            <canvas id="bulananChart"></canvas>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-blue-600 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $totalNotulen }}</div>
            <p class="mt-2 text-sm">📁 Total Notulen</p>
        </div>
        <div class="bg-gray-700 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $notulenBulanIni }}</div>
            <p class="mt-2 text-sm">🗓️ Notulen Bulan Ini</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $notulenRevisi }}</div>
            <p class="mt-2 text-sm">✏️ Butuh Revisi</p>
        </div>
        <div class="bg-indigo-600 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $totalArsip }}</div>
            <p class="mt-2 text-sm">📦 Total Arsip</p>
        </div>
        <div class="bg-purple-600 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $kategoriArsip }}</div>
            <p class="mt-2 text-sm">🗂️ Kategori Arsip</p>
        </div>
        <div class="bg-red-600 text-white p-6 rounded-xl shadow-md">
            <div class="text-4xl font-bold">{{ $arsipBulanIni }}</div>
            <p class="mt-2 text-sm">📥 Arsip Bulan Ini</p>
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 p-6 rounded-xl shadow-sm dark:shadow-md space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Aksi Cepat</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('notulen.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                + Tambah Jadwal Rapat
            </a>
            <a href="{{ route('notulen.index') }}" class="bg-gray-600 hover:bg-gray-800 text-white py-2 px-4 rounded-md">
                📋 Lihat Daftar Rapat
            </a>
            <a href="{{ route('arsip.index') }}" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded-md">
                📂 Lihat Daftar Arsip
            </a>
            <a href="{{ route('profile.edit') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md">
                ⚙️ Edit Profil
            </a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function getChartOptions(dark) {
        return {
            indexAxis: 'y', // bikin horizontal
            responsive: true,
            maintainAspectRatio: false, // biar tinggi bisa custom
            plugins: {
                legend: {
                    labels: {
                        color: dark ? '#fff' : '#333'
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: dark ? '#ccc' : '#333'
                    },
                    grid: {
                        color: dark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)'
                    }
                },
                y: {
                    ticks: {
                        color: dark ? '#ccc' : '#333'
                    },
                    grid: {
                        color: dark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)'
                    }
                }
            }
        }
    }

    const darkMode = () => document.documentElement.classList.contains('dark');
    let chartBulanan;

    function renderChart() {
        if (chartBulanan) chartBulanan.destroy();

        const ctx = document.getElementById('bulananChart').getContext('2d');
        chartBulanan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Jumlah Notulen',
                        data: @json($notulenBulanLengkap),
                        backgroundColor: 'rgba(59, 130, 246, 0.7)', // biru
                        borderRadius: 6
                    },
                    {
                        label: 'Jumlah Arsip',
                        data: @json($arsipBulanLengkap),
                        backgroundColor: 'rgba(34, 197, 94, 0.7)', // hijau
                        borderRadius: 6
                    }
                ]
            },
            options: getChartOptions(darkMode())
        });
    }

    renderChart();

    const observer = new MutationObserver(() => {
        renderChart();
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
</script>
@endpush
