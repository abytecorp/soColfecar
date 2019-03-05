<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'bs_name', 'acronym', 'nit', 'id_company_type', 'email', 'web', 'logo', 'id_cmp_state', 'us_cr'
    ];
}
