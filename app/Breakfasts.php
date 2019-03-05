<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Breakfasts extends Model
{
    protected $fillable = [
        'breakfast', 'id_record', 'claim'
    ];
}
