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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_user')->primary();
            $table->string('email');
            $table->string('nama_pengguna');
            $table->string('password')->nullable();
            $table->enum('status',['online','offline'])->default('offline');
            $table->enum('status_akun',['aktif','diblokir','pending'])->default('pending');
            $table->enum('level',['admin','kasir','owner']);
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
        Schema::dropIfExists('users');
    }
};
