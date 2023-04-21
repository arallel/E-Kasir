<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategory;
use App\Models\User;
use Hash;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        kategory::create([
            'nama_kategory' => 'Makanan',
        ]);
        kategory::create([
            'nama_kategory' => 'minuman',
        ]);
         $data = User::create([
            'nama_pengguna' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('123456'),
            'status' => 'online',
            'status_akun' => 'aktif',
            'level' => 'admin',
            'id_user' => Str::uuid()->toString(),
         ]);

    }
}
