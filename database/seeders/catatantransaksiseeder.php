<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\transaksi_barang;
use App\Models\User;

class catatantransaksiseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id = User::first();
        for ($i=1; $i < 31; $i++) {  
         $lastinv = transaksi_barang::orderBy('id_transaksi','asc')->count();
         $prefix = 'INV-';
         $lastInvoiceNumber = $lastinv + 1; 
         $invoice = $prefix . sprintf('%06d', $lastInvoiceNumber);
         $transaksi = transaksi_barang::create([
            'id_transaksi' =>  $faker->uuid,
            'no_transaksi' => $invoice,
            'tgl_transaksi' => '2023-07-'.$i,
            'waktu_transaksi'=> $faker->time,
            'total_pembayaran' => $faker->randomNumber(4),
            'id_user' => $id->id_user,
            'no_pesanan' => $faker->unique()->randomNumber(5),
            'no_resi' => $faker->unique()->randomNumber(6),
            'pembelian' => $faker->randomElement($array = array ('online','offline')),
        ]); 
        }
    }
}
