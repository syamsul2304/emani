<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;

// Redirect default ke halaman notulen
Route::get('/', [NotulenController::class, 'index']);
Route::get('/auth', function () {
    return view('auth.auth');
})->middleware('guest');
// Dashboard - pastikan pakai controller dan middleware
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Notulen - resource controller, otomatis CRUD
Route::resource('notulen', NotulenController::class)
    ->middleware(['auth']);

// Arsip - resource controller juga
Route::resource('arsip', ArsipController::class)
    ->middleware(['auth']);

// Group route untuk profil (edit, update, delete)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', function () {
    return view('profile');
})->name('profile');

});

// Include auth routes (login, register, etc)
require __DIR__.'/auth.php';



