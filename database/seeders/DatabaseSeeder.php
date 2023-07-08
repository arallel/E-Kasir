<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategory;
use App\Models\databarang;
use App\Models\setting;
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
         databarang::create([
            'id_barang' => 'A0001',
            'nama_barang' => 'test',
            'foto_barang' => NULL,
            'stok' => '12',
            'harga_barang' => '200000',
            'harga_pembelian' => '190000',
            'id_kategory' => '1',
            'status_barang' => 'aktif',
            'barcode' => '121214134',
        ]);
         setting::create([
            'id_setting' => '1',
            'nama_toko' => 'tokoku',
            'copyright_toko' => '2021,Made By Vito',
            'email_toko' => 'test@email.com',
            'is_register_admin' => 'true',
        ]);

         $this->call(databarangseeder::class);
         // $this->call(catatantransaksiseeder::class);
    }
}
