<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event', 'id_event_type', 'date_init', 'date_end', 'banner', 'id_status'
    ];
}
