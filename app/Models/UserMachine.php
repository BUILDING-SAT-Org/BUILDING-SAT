<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMachine extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'countries' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->key = 'UM' . $model->project_id . $model->id;
            $model->save();
        });
    }
}
