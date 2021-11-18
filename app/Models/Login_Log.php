<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login_Log extends Model
{
    public $table = 'login_logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'last_login',
        'ip'
    ];
}
