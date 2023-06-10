<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\potonganController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\diskonController;
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
    return view('auth.login');
});
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard','admin.dashboard')->name('dashboard');
//databarang
Route::resource('databarang',DatabarangController::class)->except(['delete']);
Route::controller(DatabarangController::class)->group(function () {
    Route::post('databarang/filter', 'filter')->name('filter.barang');
    Route::post('databarang/search', 'search')->name('search.barang');
    Route::delete('databarang/delete/{id}', 'destroy')->name('destroy.barang');
    Route::post('databarang/filter/kategory', 'filterkategory')->name('filter.kategory.barang');
    Route::post('databarang/print-label-harga/{id}','printlabel')->name('print.label.barang');
    Route::post('databarang/print-barcode/{id}','printbarcode')->name('print.barcode.barang');
});
//kategory
Route::resource('Kategory',KategoryController::class)->except(['delete']);
Route::controller(KategoryController::class)->group(function () {
    Route::delete('Kategory/delete/{id}', 'destroy')->name('destroy.kategory');
    Route::post('Kategory/search', 'search')->name('search.kategory');
});
//diskon
Route::resource('diskon',diskonController::class)->except(['delete']);
Route::controller(diskonController::class)->group(function(){
Route::delete('diskon/delete/{id}','destroy');
});

//potongan
Route::resource('potongan',potonganController::class)->except(['delete']);
Route::controller(potonganController::class)->group(function(){
   Route::post('potongan/searchbarang','searchbarang')->name('potongan.searchbarang');
   Route::delete('potongan/delete/{id}','destroy')->name('potongan.destroy');
   Route::post('potongan/Search','search')->name('potongan.search');
});

//transaksi
Route::resource('Transaksi',TransaksiBarangController::class)->except(['delete']);
Route::controller(TransaksiBarangController::class)->group(function(){
   Route::get('coba','coba')->name('Transaksi.test');
   Route::post('Transaksi/Simpan/Barang','store')->name('Transaksi.store');
   Route::get('Cetak/Struk/{id}','cetakstruk')->name('cetak.struk');
});

//user data
Route::resource('UserData',UserDataController::class)->except(['delete']);
Route::controller(UserDataController::class)->group(function(){
    Route::get('Send/mail/{id}','mail')->name('test.mail');
    Route::delete('UserData/delete/{id}', 'destroy')->name('destroy.barang');
    Route::get('Riwayat/Login/User','loguser')->name('log.user');

});
});

require __DIR__.'/auth.php';

