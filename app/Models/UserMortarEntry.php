<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMortarEntry extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'sand_co2e' => 'double',
        'cement_co2e' => 'double',
        'sand_transport_co2e' => 'double',
        'cement_transport_co2e' => 'double',
        'total_material_co2e' => 'double',
        'total_transport_co2e' => 'double',
        'total_co2e' => 'double',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
