<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notulen;
use App\Models\Arsip;

class DashboardController extends Controller
{
    public function index()
    {
        // === Statistik Notulen ===
        $totalNotulen     = Notulen::count();
        $notulenBulanIni  = Notulen::whereMonth('created_at', now()->month)->count();
        $notulenRevisi    = Notulen::where('status', 'revisi')->count();
        $notulenTerbaru   = Notulen::latest()->take(5)->get();

        // === Statistik Arsip ===
        $totalArsip       = Arsip::count();
        $kategoriArsip    = Arsip::select('kategori')->distinct()->count();
        $arsipBulanIni    = Arsip::whereMonth('created_at', now()->month)->count();

        // === Grafik Per Bulan ===
        $notulenPerBulan = Notulen::selectRaw("strftime('%m', created_at) as bulan, COUNT(*) as jumlah")
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        $arsipPerBulan = Arsip::selectRaw("strftime('%m', created_at) as bulan, COUNT(*) as jumlah")
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        $notulenBulanLengkap = [];
        $arsipBulanLengkap   = [];

        for ($i = 1; $i <= 12; $i++) {
            $key = str_pad($i, 2, '0', STR_PAD_LEFT);
            $notulenBulanLengkap[] = $notulenPerBulan[$key] ?? 0;
            $arsipBulanLengkap[]   = $arsipPerBulan[$key] ?? 0;
        }

        return view('dashboard', compact(
            'totalNotulen',
            'notulenBulanIni',
            'notulenRevisi',
            'notulenTerbaru',
            'totalArsip',
            'kategoriArsip',
            'arsipBulanIni',
            'notulenBulanLengkap',
            'arsipBulanLengkap'
        ));
    }
}
