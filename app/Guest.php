<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'gender', 'skills',
    ];

    public $timestamps = false;
}
