<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DatabarangApi;
use App\Http\Controllers\Api\KategoryApi;

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
Route::apiResource('databarang', DatabarangApi::class);
Route::controller(DatabarangApi::class)->group(function () {
    Route::get('filter/databarang', 'filterstatus');
    Route::get('search/databarang', 'search')->name('api.databarang.search');
    Route::get('filter/databarang/kategory', 'filterkategory');
    Route::get('urut/databarang/A-Z','urutAZ');
    Route::get('urut/databarang/Z-A','urutZA');
});

Route::apiResource('Kategory',KategoryApi::class);
Route::controller(KategoryApi::class)->group(function () {
    Route::get('Search/Kategory', 'search');
});
