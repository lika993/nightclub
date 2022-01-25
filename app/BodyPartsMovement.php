<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyPartsMovement extends Model
{
    protected $fillable = [
        'body_part_name', 'movements'
    ];
}
