<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        ];
    }
}
