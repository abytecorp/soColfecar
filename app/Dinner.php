<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Dinner extends Model
{
    protected $fillable = [
        'dinner', 'id_record', 'claim'
    ];
}
