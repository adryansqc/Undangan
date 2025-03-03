<?php

use App\Http\Controllers\TamuController;
use App\Http\Controllers\UndanganController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// });

// Halaman utama (daftar tamu)
Route::get('/tamu', [TamuController::class, 'index'])->name('tamu.index');
Route::get('/tamu/galeri', [TamuController::class, 'galeri'])->name('tamu.galeri');
Route::get('/tamu/create', [TamuController::class, 'create'])->name('tamu.create');
Route::post('/tamu/store', [TamuController::class, 'store'])->name('tamu.store');
Route::delete('/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');
Route::post('/tambah-foto', [TamuController::class, 'tambahFoto'])->name('tambah.foto');
Route::put('/update-foto/{id}', [TamuController::class, 'updateFoto'])->name('update.foto');
Route::delete('/hapus-foto/{id}', [TamuController::class, 'hapusFoto'])->name('hapus.foto');
Route::get('/tamu/{slug}', [TamuController::class, 'show'])->name('tamu.show');

Route::get('/undangan', [UndanganController::class, 'index'])->name('undangan.index');
Route::get('/undangan/{slug}', [UndanganController::class, 'show'])->name('undangan.show');
Route::post('/undangan/store', [UndanganController::class, 'store'])->name('kehadiran.store');
