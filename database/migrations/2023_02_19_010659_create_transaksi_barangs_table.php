<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_barang', function (Blueprint $table) {
            $table->uuid('id_transaksi')->primary();
            $table->string('no_transaksi');//no transaksi
            $table->integer('total_pembayaran');//total harga semua barang
            $table->integer('uang_dibayarkan');//uang yang dibayarkan oleh user
            $table->foreignUuid('id_user');
            $table->date('tgl_transaksi');
            $table->time('waktu_transaksi');
            $table->integer('total_kembalian');//kembalian apabila ada sisa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_barang');
    }
};
