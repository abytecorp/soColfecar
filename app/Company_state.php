<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Company_state extends Model
{
    protected $fillable = [
        'company_state', 'slug', 'description'
    ];
}
