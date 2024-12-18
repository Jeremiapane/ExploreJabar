<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-wisata-by-wilayah/{id}', [MarketingController::class, 'getWisataByWilayah']);
Route::get('/get-kendaraan-by-jumlah-peserta/{jumlah}', [MarketingController::class, 'getKendaraanByJumlahPeserta']);
Route::get('/get-pemandu-wisata-tersedia', [MarketingController::class, 'getPemanduWisataTersedia']);
