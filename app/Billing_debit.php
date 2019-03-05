<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Billing_debit extends Model
{
    protected $fillable = [
        'id_bill', 'debit', 'debit_price', 'us_cr', 'observation'
    ];
}
