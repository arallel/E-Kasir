<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\TransaksiBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('dashboard','admin.dashboard')->name('dashboard');
Route::resource('databarang',DatabarangController::class)->except(['delete']);
Route::controller(DatabarangController::class)->group(function () {
    Route::post('databarang/filter', 'filter')->name('filter.barang');
    Route::post('databarang/search', 'search')->name('search.barang');
    Route::delete('databarang/delete/{id}', 'destroy')->name('destroy.barang');
    Route::post('databarang/filter/kategory', 'filterkategory')->name('filter.kategory.barang');
});
Route::resource('Kategory',KategoryController::class)->except(['delete']);
Route::controller(KategoryController::class)->group(function () {
    Route::delete('Kategory/delete/{id}', 'destroy')->name('destroy.kategory');
    Route::post('Kategory/search', 'search')->name('search.kategory');
});
Route::controller(TransaksiBarangController::class)->group(function(){
 Route::get('Transaksi','index')->name('Transaksi.barang');
});

