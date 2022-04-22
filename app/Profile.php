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
        'jobtype',
        'jobtitle',
        'experience',
        'category',
        'salary',
        'skill',
        'cover_letter',
        'resume',
        'avatar',
        'phone_number'

    ];
}
