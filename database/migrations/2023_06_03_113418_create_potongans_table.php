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
        Schema::create('potongan', function (Blueprint $table) {
            $table->id('id_potongan');
            $table->string('id_barang');
            $table->integer('harga_awal');
            $table->integer('harga_setelah_potongan');
            $table->integer('harga_potongan_rp')->nullable();
            $table->integer('harga_potongan_persen')->nullable();
            $table->date('tgl_awal_potongan');
            $table->date('tgl_akhir_potongan');
            $table->string('kode_promo')->nullable();
            $table->enum('diskon_by_code',['true','false']);
            $table->enum('status_potongan',['aktif','tidak_aktif'])->default('aktif');
            $table->foreign('id_barang')->references('id_barang')->on('databarang');
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
        Schema::dropIfExists('potongans');
    }
};
