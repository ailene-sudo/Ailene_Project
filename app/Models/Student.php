<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentid',
        'fname',
        'mname',
        'lname',
        'address',
        'contactno',
        'image_path',
        'email',
        'status'
    ];

    /**
     * Get the user account associated with the student.
     */
    public function userAccount()
    {
        return $this->hasOne(UserAccount::class, 'username', 'email');
    }
}
