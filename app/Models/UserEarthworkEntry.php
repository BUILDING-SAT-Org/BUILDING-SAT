<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEarthworkEntry extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
