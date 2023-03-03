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
            $table->ForeignId('id_barang');
            $table->string('qty');
            $table->date('tgl_transaksi');
            $table->time('waktu_transaksi');
            $table->decimal('harga_item');
            $table->integer('no_transaksi');
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
        Schema::dropIfExists('transaksi_barangs');
    }
};
