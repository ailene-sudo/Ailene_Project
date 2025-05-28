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
        'last_login',
        'user_account_id'
    ];
    
    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'defaultpassword' => 'boolean',
        'last_login' => 'datetime',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
