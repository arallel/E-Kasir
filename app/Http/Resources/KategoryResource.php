<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\databarang;

class KategoryResource extends JsonResource
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
            'id_kategory' => $this->id_kategory,
            'nama_kategory' => $this->nama_kategory,
            'countdata' => [
                'count_seluruh_barang' => $this->databarang_count,
                'aktif' => databarang::where('id_kategory',$this->id_kategory)->where('status_barang','aktif')->count(),
                'tidak_aktif' => databarang::where('id_kategory',$this->id_kategory)->where('status_barang','tidak_aktif')->count(),
            ],
        ];
    }
}
