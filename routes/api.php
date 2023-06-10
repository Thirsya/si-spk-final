<?php

use App\Http\Controllers\Api\ApiPerhitunganController;
use App\Http\Controllers\Api\ApiPerhitunganKriteriaPerAlternatifController;
use App\Http\Controllers\Api\ApiMetodeEntropyController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('perhitungan', [ApiPerhitunganController::class, 'index'], ['as' => 'api'])->name('api.perhitungan.index');
Route::post('perhitungan', [ApiPerhitunganController::class, 'store'], ['as' => 'api'])->name('api.perhitungan.store');
Route::get(
    'kriteria-per-alternatif',
    [ApiPerhitunganKriteriaPerAlternatifController::class, 'index'],
    ['as' => 'api']
)->name('api.kriteria.per.alternatif.index');
Route::post(
    'kriteria-per-alternatif',
    [ApiPerhitunganKriteriaPerAlternatifController::class, 'store'],
    ['as' => 'api']
)->name('api.kriteria.per.alternatif.store');

Route::post('perhitungantotal', [ApiMetodeEntropyController::class, 'PerhitunganTotal'])->name('api.test.index');
Route::post('inputKriteriaAlternatif', [ApiMetodeEntropyController::class, 'TambahDataKriteriaDanAlternatif'])
    ->name('api.input.kriteria.alternatif');