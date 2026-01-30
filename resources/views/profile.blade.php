@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
        Profil Pengguna
    </h2>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Informasi Profil</h3>

    <p><strong>Nama:</strong> {{ Auth::user()->name ?? 'User' }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email ?? 'user@example.com' }}</p>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
