<?php

use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\TamuController;
use App\Http\Resources\GaleriResource;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// route::get('/galeri', function () {
//     return GaleriResource::collection(Galeri::all());
// });

Route::get('/galeris', [GaleriController::class, 'index']);
