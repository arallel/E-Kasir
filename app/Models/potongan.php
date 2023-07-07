<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class potongan extends Model
{
    use HasFactory;
    protected $table = 'potongan';
    protected $primaryKey = 'id_potongan';
    protected $fillable = [
        'id_barang',
        'harga_awal',
        'harga_potongan_rp',
        'harga_potongan_persen',
        'tgl_awal_potongan',
        'tgl_akhir_potongan',
        'status_potongan',
        'diskon_by_code',
        'kode_promo',
        'harga_setelah_potongan',
    ];
    public function databarang()
    {
        return $this->belongsTo(databarang::class,'id_barang');
    }
}
