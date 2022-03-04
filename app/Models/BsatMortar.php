<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatMortar extends Model
{
    use HasFactory;

    protected $primaryKey = 'key';
    public $incrementing = true;

    protected $hidden = ['key', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->id = 'BMOR' . $model->key;
            $model->save();
        });
    }
}
