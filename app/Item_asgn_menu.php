<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Item_asgn_menu extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
    public function sub_item()
    {
        return $this->belongsTo(Sub_item::class, 'id_sub_item');
    }
}
