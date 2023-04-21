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
        Schema::create('diskon', function (Blueprint $table) {
            $table->id('id_diskon');
            $table->string('nama_diskon');
            $table->foreignUuid('id_barang');
            $table->integer('harga_potongan');
            $table->integer('harga_setelah_potongan');
            $table->date('tgl_awal_diskon');
            $table->date('tgl_akhir_diskon');
            $table->enum('status_diskon',['aktif','tidak_aktif'])->default('aktif');
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
        Schema::dropIfExists('diskon');
    }
};
