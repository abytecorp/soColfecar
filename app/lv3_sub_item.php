<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class lv3_sub_item extends Model
{
    public function sub_item()
    {
        return $this->belongsTo(Sub_item::class);
    }
}
