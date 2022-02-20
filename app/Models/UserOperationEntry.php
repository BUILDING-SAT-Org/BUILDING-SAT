<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOperationEntry extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'total_co2e' => 'double',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
