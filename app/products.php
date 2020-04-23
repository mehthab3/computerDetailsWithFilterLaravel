<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    public $fillable = [
        'name','image','price','brand','processortype','screensize','touchscreen','availability'
    ];

    public $hidden = [
        'id'
    ];
}
