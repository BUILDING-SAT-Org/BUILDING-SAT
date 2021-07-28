<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    public function machines ()
    {
        return $this->hasMany('App\Models\UserMachine','project_id');
    }
}
