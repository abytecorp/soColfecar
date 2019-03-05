<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'id_assistant', 'id_event', 'id_plan', 'date_init', 'date_end', 'created_at', 'updated_at', 'id_record_state', 'enroll_name', 'enroll_email', 'printed_at', 'printed_by', 'id_status_gafete','id_partner'
    ];
    // public function assistants()
    // {
    //     return $this->hasMany(Assistant::class,'id');
    // }
    // public function billHas()
    // {
    //     return $this->belongsToMany(Bill::class,'bills','id_records', 'id')->withTimestamps();
    // }
}
