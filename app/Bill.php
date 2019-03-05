<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'bill_number', 'id_record', 'price', 'purchase_order', 'close_date', 'way_to_pay', 'us_cr', 'us_up'
    ];
}
