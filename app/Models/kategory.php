<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategory extends Model
{
    use HasFactory;
    protected $table = 'kategory';
    protected $primaryKey = 'id_kategory';
    protected $fillable = [
        'nama_kategory',
    ];
    public function kategory()
    {
        return $this->hasOne(databarang::class,'id_kategory');
    }
}
