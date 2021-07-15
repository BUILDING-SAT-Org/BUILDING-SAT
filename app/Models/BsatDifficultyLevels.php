<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatDifficultyLevels extends Model
{
    use HasFactory;


    public $table = "bsat_difficulty_levels";
    protected $fillable = ['difficulty_level', 'bsat_subphase_id', 'difficulty_factor', 'bulk_density', 'bulking_factor'];

    protected $hidden = ['bsat_subphase_id','created_at', 'updated_at'];
}
