<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatDifficultyLevel extends Model
{
    use HasFactory;


    public $table = "bsat_difficulty_levels";
    protected $fillable = ['difficulty_level', 'sub_phase_id', 'difficulty_factor', 'bulk_density', 'bulking_factor'];

    protected $hidden = ['created_at', 'updated_at'];
}
