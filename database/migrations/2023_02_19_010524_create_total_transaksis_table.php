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
        Schema::create('total_transaksi', function (Blueprint $table) {
            $table->uuid('id_total_transaksi')->primary();
            $table->ForeignId('no_transaksi');
            $table->decimal('total_pembayaran');
            $table->ForeignId('id_user');
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
        Schema::dropIfExists('total_transaksis');
    }
};
