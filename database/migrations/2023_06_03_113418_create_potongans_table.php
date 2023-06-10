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
            $table->string('nama_potongan');
            $table->foreignUuid('id_barang');
            $table->integer('harga_potongan');
            $table->integer('harga_setelah_potongan');
            $table->date('tgl_awal_potongan');
            $table->date('tgl_akhir_potongan');
            $table->enum('status_potongan',['aktif','tidak_aktif'])->default('aktif');
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
