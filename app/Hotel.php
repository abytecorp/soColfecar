<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'hotel_name', 'id_city', 'address', 'email', 'web', 'stars' 
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class,'id_hotel');
    }
}