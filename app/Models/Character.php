<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'biography', 'actor_id'];

    public $incrementing = false;
    protected $keyType = 'string';
}