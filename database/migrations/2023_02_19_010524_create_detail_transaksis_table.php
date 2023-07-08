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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->uuid('id_detail_transaksi')->primary();
            $table->string('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('databarang');
            $table->ForeignUuid('id_transaksi');
            $table->string('qty');
            $table->integer('harga_asli');
            $table->integer('harga_item');
            $table->integer('jumlah_diskon_rp')->nullable(); 
            $table->integer('jumlah_diskon_persen')->nullable();
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
        Schema::dropIfExists('detail_transaksi');
    }
};
