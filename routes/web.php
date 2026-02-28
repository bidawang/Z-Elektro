<?php

use App\Http\Controllers\KatalogController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Katalog Utama (Terbuka untuk Umum)
Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/produk/{id}', [KatalogController::class, 'show'])->name('katalog.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Barang (Hanya yang sudah Login)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('barang', BarangController::class);
});
