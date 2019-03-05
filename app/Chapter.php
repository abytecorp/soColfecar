<?php

namespace soColfecar;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['chapter','description','id_chapter_type','is_billing','date_init','date_end','banner'];
}
