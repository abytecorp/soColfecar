<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $fillable = [
        'names', 'last_names', 'id_type', 'id_number', 'id_city', 'address','tel','cel','position', 'email', 'id_company', 'id_status'
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }
}
