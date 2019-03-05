<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Id_type extends Model
{
    protected $fillable = [
        'id_type', 'slug', 'description', 'id_status'
    ];
}
