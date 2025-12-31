<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = [
        'name',
        'price',
        'max_users',
        'max_services',
        'max_appointments',
        'active',
    ];
}
