<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Refreshment extends Model
{
    protected $fillable = [
        'refreshment', 'id_record', 'claim'
    ];
}