<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'place', 'city_id', 'address'
    ];
}
