<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class DatabarangResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_barang' => $this->id_barang,
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'stok' => $this->stok,
            'id_kategory' => $this->id_kategory,
            'nama_kategory' => $this->kategory->nama_kategory,
            'status_barang' => $this->status_barang,
            'barcode' => $this->barcode,
            'harga_barang' => $this->harga_barang,
            'harga_pembelian' => $this->harga_pembelian,
            'foto_barang' => ($this->foto_barang != null)? ltrim(Storage::url($this->foto_barang), '/') : 'assets/images/no-image.jpg',
            'created_at' => $this->created_at,
            'banyak_dijual' => $this->detailtransaksi->sum('qty'),
        ];

    }
}
