<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Sub_item extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
