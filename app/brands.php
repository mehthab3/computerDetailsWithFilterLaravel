<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    public $fillable = [
        'name'
    ];

    public $hidden = [
        'id'
    ];
}
