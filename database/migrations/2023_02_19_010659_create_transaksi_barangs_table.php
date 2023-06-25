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
            $table->string('no_pesanan')->nullable();//no transaksi
            $table->string('no_resi')->nullable();//no transaksi
            $table->integer('total_pembayaran');//total harga semua barang
            $table->integer('uang_dibayarkan')->nullable();//uang yang dibayarkan oleh user
            $table->foreignUuid('id_user');
            $table->date('tgl_transaksi');
            $table->time('waktu_transaksi')->nullable();
            $table->integer('total_kembalian')->nullable();//kembalian apabila ada sisa
            $table->enum('pembelian',['offline','online'])->default('offline');
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
