<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccount extends Model
{
    use HasFactory;
    
    protected $table = 'user_accounts';
    
    protected $fillable = [
        'username',
        'password',
        'defaultpassword',
        'role',
        'status',
        'last_login'
    ];
    
    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'defaultpassword' => 'boolean',
        'last_login' => 'datetime',
    ];
}
