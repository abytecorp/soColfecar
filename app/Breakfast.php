<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Breakfast extends Model
{
    protected $fillable = [
        'breakfast', 'id_record', 'claim'
    ];
}
