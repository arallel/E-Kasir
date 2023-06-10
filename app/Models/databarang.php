<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class databarang extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'databarang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'foto_barang',
        'stok',
        'id_kategory',
        'status_barang',
        'barcode',
        'harga_barang',
        'harga_pembelian',
    ];
    public function kategory()
    {
        return $this->belongsTo(kategory::class, 'id_kategory','id_kategory');
    }
}
