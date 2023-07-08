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
        Schema::create('login_log', function (Blueprint $table) {
           $table->id('id_log');
           $table->foreignUuid('user_id');
           $table->string('user_agent')->nullable();
           $table->string('ip_address')->nullable();
           $table->date('date_login_at');
           $table->time('time_login_at');
           $table->date('date_logout_at')->nullable(); 
           $table->time('time_logout_at')->nullable();
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
        Schema::dropIfExists('login_log');
    }
};
