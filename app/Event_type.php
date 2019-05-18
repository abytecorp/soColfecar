<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Event_type extends Model
{
    protected $fillable = [
        'event_type', 'slug', 'icon', 'description', 'id_status'
    ];
}
