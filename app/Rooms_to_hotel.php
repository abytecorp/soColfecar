<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Rooms_to_hotel extends Model
{
    protected $fillable = [
        'id_record', 'id_room'
    ];
}
