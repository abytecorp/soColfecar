<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Hotel_to_event extends Model
{
    protected $fillable = [
        'event_id','hotel_id','single_rooms','double_rooms','status_id'
    ];
}
