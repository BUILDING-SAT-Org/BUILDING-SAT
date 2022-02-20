<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatMainPhase extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function subPhases()
    {
        return $this->hasMany(BsatSubPhase::class, 'main_phase_id', 'id');
    }

    public function emissionResults()
    {
        return $this->hasMany(ProjectSubPhaseEmission::class, 'main_phase_id', 'id');
    }
}
