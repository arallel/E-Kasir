<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DatabarangApi;
use App\Http\Controllers\Api\KategoryApi;
use App\Http\Controllers\Api\catatantransaksi;
use App\Http\Controllers\potonganController;

use App\Http\Controllers\Api\AuthUserApi;

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
Route::controller(DatabarangApi::class)->group(function (){
  Route::get('getitembybarcode','getitembybarcode');
  Route::get('getitembyname','getitembyname');
  Route::get('chart/penjualan','chartpenjualan');
});
Route::controller(AuthUserApi::class)->group(function (){
    Route::post('login','Login');
    Route::post('logout','Logout');
  });
Route::controller(potonganController::class)->group(function(){
   Route::get('potongan/searchbarang','searchbarang')->name('potongan.searchbarang');
   Route::get('potongan/checkkupon','checkkupon');
});
  Route::apiResource('catatan/transaksi',catatantransaksi::class);
Route::middleware(['auth:sanctum'])->group(function () {
  Route::apiResource('databarang', DatabarangApi::class)->except(['index']);
  Route::controller(DatabarangApi::class)->group(function () {
    Route::get('databarang','filtersearch');
  });
  Route::apiResource('kategory',KategoryApi::class);
  Route::controller(KategoryApi::class)->group(function () {
    Route::get('search/kategory', 'search');
  });
});

