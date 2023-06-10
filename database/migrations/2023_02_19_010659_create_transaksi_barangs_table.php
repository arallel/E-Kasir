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
            $table->string('no_transaksi');
            $table->decimal('total_pembayaran');
            $table->foreignUuid('id_user');
            $table->date('tgl_transaksi');
            $table->time('waktu_transaksi');
            $table->decimal('total_kembalian');
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
