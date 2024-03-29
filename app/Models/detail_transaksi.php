<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class detail_transaksi extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = [
      'id_detail_transaksi',
       'id_barang',
       'id_transaksi',
        'qty',
        'harga_item',
        'harga_asli',
        'jumlah_diskon_rp',
        'jumlah_diskon_persen',
    ];
    public function transaksi()
    {
         return $this->belongsTo(transaksi_barang::class,'id_transaksi');
    }
    public function databarang()
    {
         return $this->belongsTo(databarang::class,'id_barang');
    }
    public function user()
    {
         return $this->belongsTo(User::class,'id_user');
    }
    public function checkpotongan(){
        return $this->hasOne(potongan::class,'id_barang','id_barang');
    }
}
