<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'plan', 'pl_desc', 'id_event', 'price', 'id_status', 'id_company_state', 'academic_agenda', 'lunches', 'refreshments', 'dinner', 'breakfast', 'host','invitation_type'
    ];
}