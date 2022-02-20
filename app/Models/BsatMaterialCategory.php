<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsatMaterialCategory extends Model
{
    use HasFactory;

    protected $casts = [
        'countries' => 'array'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->key = 'BCAT' . $model->id;
            $model->save();
        });
    }

    public function materials()
    {
        return $this->hasMany(BsatMaterial::class, 'category_id', 'id');
    }

    public function userMaterials()
    {
        return $this->hasMany(UserMaterial::class, 'category_id', 'id');
    }
}
