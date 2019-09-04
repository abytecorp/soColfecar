<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Single_room extends Model
{
    protected $fillable = [
        'room_number','obs','hotel_to_event_id','record_id'
    ];
}
