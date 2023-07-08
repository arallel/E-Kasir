<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $primaryKey = 'id_setting';
    protected $fillable = [
        'nama_toko',
        'copyright_toko',
        'email_toko',
        'is_register_admin',
    ];
}
