<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatMachine extends Model
{
    use HasFactory;

    protected $casts = [
        'countries' => 'array',
        'gwp' => 'double',
    ];

    protected $primaryKey = 'key';
    public $incrementing = true;

    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->id = 'BM' . $model->key;
            $model->save();
        });
    }

}
