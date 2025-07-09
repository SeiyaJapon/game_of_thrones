<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public $fillable = [
        'id',
        'name',
        'biography',
        'actor_id',
        'house_name',
        'nickname',
        'character_image_thumb',
        'character_image_full',
        'character_link',
        'siblings',
        'parents',
        'killed',
        'guarded_by',
    ];

    public $incrementing = false;
    public $keyType = 'string';

    public $casts = [
        'siblings' => 'array',
        'parents' => 'array',
        'killed' => 'array',
        'guarded_by' => 'array',
    ];

    //    Generación automática de UUID
    //    protected static function boot() {
    //        parent::boot();
    //
    //        static::creating(function ($model) {
    //            if (empty($model->id)) {
    //                $model->id = (string) Str::uuid();
    //            }
    //        });
    //    }
}