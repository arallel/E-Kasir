<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Http;
use App\Models\databarang;

class databarangseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $response = Http::get('https://fakestoreapi.com/products');
              if ($response->successful()) {
                   $groceryItems = json_decode($response, true);
                  foreach ($groceryItems as $groceryItem) {
                   // dd($groceryItem);
                               databarang::create([
                'id_barang' => $faker->uuid(),
                'nama_barang' => $groceryItem['title'],
                'foto_barang' =>  $groceryItem['image'], 
                'stok' => $faker->numberBetween(1, 100),
                'harga_barang' => $faker->numberBetween(10000, 1000000),
                'harga_pembelian' => $faker->numberBetween(10000, 1000000),
                'id_kategory' => $faker->numberBetween(1, 2),
                'status_barang' => $faker->randomElement(['aktif', 'tidak_aktif']),
                'barcode' => $faker->numberBetween(1000000000000, 9999999999999),
            ]);
                   }

        }
    }
}
