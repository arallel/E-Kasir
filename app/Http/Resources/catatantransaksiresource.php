<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class catatantransaksiresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_transaksi' => $this->id_transaksi,
            'no_transaksi' => $this->no_transaksi,
            'tgl_transaksi' => $this->tgl_transaksi,
            'waktu_transaksi' => $this->waktu_transaksi,
            'total_pembayaran' => $this->total_pembayaran,
            'uang_dibayarkan' => $this->uang_dibayarkan,
            'id_user' => $this->id_user,
            'total_kembalian' => $this->total_kembalian,
            'pembelian' => $this->pembelian,
            'no_pesanan' => $this->no_pesanan,
            'no_resi' => $this->no_resi,
            'detailtransaksi' => $this->detailtransaksi->map(function ($detailTransaksi) {
                return [
                    'id_transaksi' => $detailTransaksi->id_transaksi,
                    'id_barang' => $detailTransaksi->id_barang,
                    'qty' => $detailTransaksi->qty,
                    'harga_item' => $detailTransaksi->harga_item,
                    'harga_asli' => $detailTransaksi->harga_asli,
                    'jumlah_diskon_rp' => $detailTransaksi->jumlah_diskon_rp,
                    'jumlah_diskon_persen' => $detailTransaksi->jumlah_diskon_persen,
                ];
            }),
        ];
    }
}
