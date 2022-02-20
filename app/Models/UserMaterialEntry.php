<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMaterialEntry extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'landfill_data' => 'array',
        'total_material_co2e' => 'double',
        'local_transport_co2e' => 'double',
        'overseas_transport_co2e' => 'double',
        'total_transport_co2e' => 'double',
        'total_co2e' => 'double',
        'maintenance_material_co2e' => 'double',
        'landfill_co2e' => 'double',
        'salvage_co2e' => 'double',
        'salvage_quantity' => 'double',
        'landfill_quantity' => 'double',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
