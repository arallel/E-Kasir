<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diskon extends Model
{
    use HasFactory;
    protected $table = 'diskon';
    protected $primaryKey = 'id_diskon';
    protected $fillable = [
        'kode_promo',
        'persen_diskon',
        'tgl_mulai_promo',
        'tgl_selesai_promo',
        'status_diskon',
    ];
    // public function databarang()
    // {
    //     return $this->belongsTo(databarang::class,'id_barang');
    // }
}
