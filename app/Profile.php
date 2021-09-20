<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'gender',
        'dob',
        'experience',
        'bio',
        'cover_letter',
        'resume',
        'avatar',
        'phone_number'

    ];
}
