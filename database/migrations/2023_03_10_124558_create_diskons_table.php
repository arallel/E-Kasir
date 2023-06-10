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
            $table->string('kode_promo');
            $table->integer('persen_diskon');
            $table->date('tgl_mulai_promo');
            $table->date('tgl_selesai_promo');
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
