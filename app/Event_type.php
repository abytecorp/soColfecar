<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Event_type extends Model
{
    protected $fillable = [
        'event_type', 'slug', 'description', 'id_status'
    ];
}
