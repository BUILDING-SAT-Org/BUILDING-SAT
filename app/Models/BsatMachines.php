<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatMachines extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->key = 'BM' . $model->id;
            $model->save();
        });
    }
}
