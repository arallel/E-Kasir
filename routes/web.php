<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\DiskonController;
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
//databarang
Route::resource('databarang',DatabarangController::class)->except(['delete']);
Route::controller(DatabarangController::class)->group(function () {
    Route::delete('databarang/delete/{id}', 'destroy')->name('destroy.barang');
    Route::post('databarang/filter', 'filter')->name('filter.barang');
    Route::post('databarang/search', 'search')->name('search.barang');
    Route::post('databarang/filter/kategory', 'filterkategory')->name('filter.kategory.barang');
});
//kategory
Route::resource('Kategory',KategoryController::class)->except(['delete']);
Route::controller(KategoryController::class)->group(function () {
    Route::delete('Kategory/delete/{id}', 'destroy')->name('destroy.kategory');
    Route::post('Kategory/search', 'search')->name('search.kategory');
});
//diskon
Route::resource('Diskon',DiskonController::class)->except(['delete']);

Route::controller(DiskonController::class)->group(function(){
   Route::post('Diskon/searchbarang','searchbarang')->name('Diskon.searchbarang');
   Route::delete('Diskon/delete/{id}','destroy')->name('Diskon.destroy');
   Route::post('Diskon/Search','search')->name('Diskon.search');
});

//transaksi
Route::resource('Transaksi',TransaksiBarangController::class)->except(['delete']);
Route::controller(TransaksiBarangController::class)->group(function(){
   Route::get('coba','coba')->name('Transaksi.test');
   Route::post('Transaksi/Input/Barang','storesesion')->name('Transaksi.store.session');
});

