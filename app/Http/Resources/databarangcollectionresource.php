<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Storage;

class databarangcollectionresource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_barang' => $this->id_barang,
            'nama_barang' => $this->nama_barang,
            'stok' => $this->stok,
            'id_kategory' => $this->id_kategory,
            'nama_kategory' => $this->kategory->nama_kategory,
            'status_barang' => $this->status_barang,
            'barcode' => $this->barcode,
            'harga_barang' => ($this->checkpotongan != null && $this->checkpotongan->status_potongan == 'aktif')?$this->checkpotongan->harga_setelah_potongan:$this->harga_barang,
            'harga_normal' => $this->harga_barang,
            'harga_pembelian' => $this->harga_pembelian,
            'foto_barang' => ($this->foto_barang != null)? ltrim(Storage::url($this->foto_barang), '/') : 'assets/images/no-image.jpg',
            'created_at' => $this->created_at,
            'banyak_dijual' => $this->detailtransaksi->sum('qty'),
        ];
    }
}
