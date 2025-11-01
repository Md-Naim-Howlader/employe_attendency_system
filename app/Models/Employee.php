<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'employee_id',
        'department',
        'gender',
        'blood_group',
        'photo',
        'join_date',
    ];
}
