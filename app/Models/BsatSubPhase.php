<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatSubPhase extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function earthWorkEntries()
    {
        return $this->hasMany(UserEarthworkEntry::class, 'sub_phase_id', 'id');
    }

    public function materialEntries()
    {
        return $this->hasMany(UserMaterialEntry::class, 'sub_phase_id', 'id');
    }

    public function mortarEntries()
    {
        return $this->hasMany(UserMortarEntry::class, 'sub_phase_id', 'id');
    }

    public function operationEntries()
    {
        return $this->hasMany(UserOperationEntry::class, 'sub_phase_id', 'id');
    }

    public function wasteEntries()
    {
        return $this->hasMany(UserWasteGeneratedEntry::class, 'sub_phase_id', 'id');
    }

    public function emissionResults()
    {
        return $this->hasMany(ProjectSubPhaseEmission::class, 'sub_phase_id', 'id');
    }
}
