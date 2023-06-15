<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class transaksi_barang extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'transaksi_barang';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi',
        'no_transaksi',
        'tgl_transaksi',
        'waktu_transaksi',
        'total_pembayaran',
        'uang_dibayarkan',
        'id_user',
        'total_kembalian',
    ];
    public function detailtransaksi()
    {
         return $this->hasMany(detail_transaksi::class,'id_transaksi');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id_user');
    }
}
