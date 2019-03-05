<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
