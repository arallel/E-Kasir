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
        Schema::create('databarang', function (Blueprint $table) {
            $table->uuid('id_barang')->primary();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('foto_barang')->nullable();
            $table->integer('stok');
            $table->integer('harga_barang');
            $table->integer('harga_pembelian');
            $table->foreignId('id_kategory');
            $table->enum('status_barang',['aktif','tidak_aktif'])->default('aktif');
            $table->string('barcode');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('databarang');
    }
};
