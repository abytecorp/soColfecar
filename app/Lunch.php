<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $fillable = [
        'lunch', 'id_record', 'claim'
    ];
}
