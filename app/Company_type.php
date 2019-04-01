<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Company_type extends Model
{
    //protected $table = 'company_types';
    protected $fillable = [
        'company_type', 'slug', 'description', 'id_status'
    ];
    
}
