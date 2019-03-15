<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'bs_name', 'acronym', 'nit', 'verification_digit', 'address', 'id_company_type', 'phone1', 'phone2', 'phone3', 'id_status',
         'email', 'web', 'logo', 'id_cmp_state', 'us_cr', 'id_city', 'afiliation_state_id'
    ];
}
