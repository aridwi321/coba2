<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class input extends Model
{
    protected $fillable = [
        'category', 'weight','price'
    ];
}
