<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'id_room_type', 'id_hotel', 'room_number'
    ];
    public function room_types()
    {
        return $this->belongsTo(Room_type::class,'id_room_type');
    }
    public function rooms_to_hotels()
    {
        return $this->hasMany(Rooms_to_hotel::class,'id_room');
    }
}
