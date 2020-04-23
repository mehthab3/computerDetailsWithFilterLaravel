<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class processortypes extends Model
{
    public $fillable = [
        'name'
    ];

    public $hidden = [
        'id'
    ];
}
