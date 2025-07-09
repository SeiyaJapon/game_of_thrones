<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['id', 'name', 'biography'];

    public $incrementing = false;
    protected $keyType = 'string';

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