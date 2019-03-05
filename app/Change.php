<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $fillable = [
        'description', 'id_usuario', 'id_item', 'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
