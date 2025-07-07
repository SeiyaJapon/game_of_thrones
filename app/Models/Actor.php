<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'birthdate', 'nationality'];

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