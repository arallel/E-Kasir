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
        'id_barang',
        'nama_diskon',
        'harga_potongan',
        'tgl_awal_diskon',
        'tgl_akhir_diskon',
        'status_diskon',
        'harga_setelah_potongan',
    ];
    public function databarang()
    {
        return $this->belongsTo(databarang::class,'id_barang');
    }
}
