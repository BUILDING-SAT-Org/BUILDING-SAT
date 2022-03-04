<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWasteGeneratedEntry extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'transport_co2e' => 'double',
        'material_co2e' => 'double',
        'total_co2e' => 'double',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
