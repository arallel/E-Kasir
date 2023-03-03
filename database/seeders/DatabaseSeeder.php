<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategory;

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

    }
}
