<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\transaksi_barang;
use App\Models\User;
use App\Models\databarang;
use App\Models\detail_transaksi;
use Str;

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
        for ($i = 1; $i <= 30; $i++) {
            $lastinv = transaksi_barang::orderBy('id_transaksi', 'desc')->count();
            $prefix = 'INV-';
            $lastInvoiceNumber = $lastinv + 1;
            $invoice = $prefix . sprintf('%06d', $lastInvoiceNumber);

            $transaksi = transaksi_barang::create([
                'id_transaksi' => $faker->uuid,
                'no_transaksi' => $invoice,
                'tgl_transaksi' => '2023-07-' . $i,
                'waktu_transaksi' => $faker->time,
                'total_pembayaran' => $faker->randomNumber(5, true),
                'id_user' => $id->id_user,
                'no_pesanan' => $faker->unique()->randomNumber(5),
                'no_resi' => $faker->unique()->randomNumber(6),
                'pembelian' => $faker->randomElement($array = ['online', 'offline']),
            ]);

            $barang = databarang::with('checkpotongan')->where('id_barang', 'A0001')->first();
            $qty = $faker->numberBetween(1, 3);
            $detail_transaksi = detail_transaksi::create([
                'id_detail_transaksi' => Str::uuid()->toString(),
                'id_barang' => $barang->id_barang,
                'id_transaksi' => $transaksi->id_transaksi,
                'qty' => $qty,
                'harga_item' => $barang->harga_barang * $qty,
                'harga_asli' => $barang->harga_barang,
                'jumlah_diskon_rp' => ($barang->checkpotongan && $barang->checkpotongan->harga_potongan_rp) ? $barang->checkpotongan->harga_potongan_rp : null,
                'jumlah_diskon_persen' => ($barang->checkpotongan && $barang->checkpotongan->harga_potongan_persen) ? $barang->checkpotongan->harga_potongan_persen : null,
            ]);
            
        }
    }
}
