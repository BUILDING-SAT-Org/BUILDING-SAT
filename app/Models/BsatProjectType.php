<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatProjectType extends Model
{
    use HasFactory;

    public $table = "bsat_project_types";
    protected $fillable = ['name', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];
}
