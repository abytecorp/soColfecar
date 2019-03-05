<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Reg_observation extends Model
{
    protected $fillable = [
        'id_record', 'us_cr', 'obs'
    ];
    
}

