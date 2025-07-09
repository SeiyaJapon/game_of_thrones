<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public $fillable = ['id', 'name', 'biography'];

    public $incrementing = false;
    public $keyType = 'string';

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