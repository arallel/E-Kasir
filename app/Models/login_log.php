<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login_log extends Model
{
    use HasFactory;
     protected $table = 'login_log';
    protected $primaryKey = 'id_log';
    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
        'date_login_at',
        'date_logout_at',
        'time_login_at',
        'time_logout_at',
        
    ];
     protected $hidden = [
        'user_id',
        'user_agent',
        'ip_address',
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
