<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function userMaterials()
    {
        return $this->hasMany(UserMaterial::class, 'project_id', 'id');
    }

    public function userMachines()
    {
        return $this->hasMany(UserMachine::class, 'project_id', 'id');
    }

    public function userVehicles()
    {
        return $this->hasMany(UserVehicle::class, 'project_id', 'id');
    }

    public function earthWorkEntries()
    {
        return $this->hasMany(UserEarthworkEntry::class, 'project_id', 'id');
    }

    public function materialEntries()
    {
        return $this->hasMany(UserMaterialEntry::class, 'project_id', 'id');
    }

    public function mortarEntries()
    {
        return $this->hasMany(UserMortarEntry::class, 'project_id', 'id');
    }

    public function mainPhases()
    {
        return $this->hasMany(BsatMainPhase::class, 'project_id', 'id');
    }

    public function emissionResults()
    {
        return $this->hasMany(ProjectSubPhaseEmission::class, 'project_id', 'id');
    }

    public function recommendations()
    {
        return $this->hasMany(ProjectRecommendation::class, 'project_id', 'id');
    }
}
