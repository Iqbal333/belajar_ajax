<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nim',
        'name',
        'date_of_birth',
        'prodi',
        'faculty',
        'phone_number',
        'religion',
        'email',
        'gender',
        'address'
    ];
}
