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
            $table->string('nama_barang');
            $table->string('foto_barang')->nullable();
            $table->string('stok');
            $table->string('harga_barang');
            $table->ForeignId('id_kategory');
            $table->enum('status_barang',['aktif','tidak_aktif'])->default('aktif');
            $table->string('barcode');
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
        Schema::dropIfExists('databarangs');
    }
};
