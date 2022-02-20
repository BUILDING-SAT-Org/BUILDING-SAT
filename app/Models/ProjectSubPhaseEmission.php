<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubPhaseEmission extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'material_co2_emission' => 'double',
        'machinery_co2_emission' => 'double',
        'transport_co2_emission' => 'double',
        'energy_co2_emission' => 'double',
        'water_co2_emission' => 'double',
        'total_co2_emission' => 'double'
    ];
}
