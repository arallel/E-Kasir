<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DatabarangApi;
use App\Http\Controllers\Api\KategoryApi;
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
});
Route::controller(AuthUserApi::class)->group(function (){
    Route::post('login','Login');
    Route::post('logout','Logout');
  });

Route::middleware(['auth:sanctum'])->group(function () {
  Route::apiResource('databarang', DatabarangApi::class);
  Route::controller(DatabarangApi::class)->group(function () {
    Route::get('urutkan/databarang','urutkan');
    Route::get('databarang','filtersearch');
    Route::get('chart/penjualan','chartpenjualan');
  });
  Route::apiResource('kategory',KategoryApi::class);
  Route::controller(KategoryApi::class)->group(function () {
    Route::get('search/kategory', 'search');
  });
});

