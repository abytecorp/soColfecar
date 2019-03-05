<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
