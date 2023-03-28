<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_barang extends Model
{
    use HasFactory;
    protected $table = 'transaksi_barang';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'waktu_transaksi',
        'total_pembayaran',
        'id_user',
        'total_kembalian',
    ];
}
