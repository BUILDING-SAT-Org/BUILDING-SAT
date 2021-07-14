<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatSubphases extends Model
{
    use HasFactory;

    public function difficulty_levels ()
    {
        return $this->hasMany('App\Models\BsatDifficultyLevels');
    }
}
