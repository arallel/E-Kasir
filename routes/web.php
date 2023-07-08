<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\potonganController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatatanTransaksi;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
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
//dashboard
Route::controller(DashboardController::class)->group(function(){
    Route::get('dashboard','index')->name('dashboard');
});
//databarang
Route::resource('databarang',DatabarangController::class)->except(['delete']);
Route::controller(DatabarangController::class)->group(function () {
    Route::delete('databarang/delete/{id}', 'destroy')->name('destroy.barang');
    Route::patch('databarang/update-stok/{id}', 'addstok');
    Route::post('databarang/print-label-harga/{id}','printlabel')->name('print.label.barang');
    Route::post('databarang/print-barcode/{id}','printbarcode')->name('print.barcode.barang');
});
//kategory
Route::resource('Kategory',KategoryController::class)->except(['delete']);
Route::controller(KategoryController::class)->group(function () {
    Route::delete('Kategory/delete/{id}', 'destroy')->name('destroy.kategory');
});

//potongan
Route::resource('potongan',potonganController::class)->except(['delete','show']);
Route::controller(potonganController::class)->group(function(){
   // Route::post('potongan/searchbarang','searchbarang')->name('potongan.searchbarang');
   Route::delete('potongan/delete/{id}','destroy')->name('potongan.destroy');
   Route::post('potongan/Search','search')->name('potongan.search');
   Route::post('potongan/{id}','show')->name('potongan.show');
});

//transaksi
Route::resource('Transaksi',TransaksiBarangController::class)->only(['index','store']);
Route::controller(TransaksiBarangController::class)->group(function(){
   Route::post('Transaksi/Simpan/Barang','store')->name('Transaksi.store');
   Route::get('Cetak/Struk/{id}','cetakstruk')->name('cetak.struk');
});
//catatan transaksi
Route::resource('Catatan-transaksi',CatatanTransaksi::class)->only(['index','show','create','store','delete']);

//user data
Route::resource('UserData',UserDataController::class)->except(['delete']);
 Route::controller(UserDataController::class)->group(function(){
    Route::get('Send/mail/{id}','mail')->name('test.mail');
    Route::delete('UserData/delete/{id}', 'destroy')->name('destroy.barang');
    Route::get('Riwayat/Login/User','loguser')->name('log.user');
 });
Route::resource('setting',SettingController::class)->only(['index','update']);
});
//laporan
Route::resource('Laporan',LaporanController::class);
//setting
require __DIR__.'/auth.php';

