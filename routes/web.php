<?php

use App\Http\Controllers\UndanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undangan', [UndanganController::class, 'index'])->name('undangan.index');
Route::get('/undangan/{slug}', [UndanganController::class, 'show'])->name('undangan.show');
