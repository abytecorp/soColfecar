<?php

namespace soColfecar;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable; 
    use ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'id_user_type', 'id_status', 'id_card'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_type()
    {
        return $this->belongsTo(User_type::class, 'id_user_type');
    }

    public function status()
    {
        return $this->belongsTo(Statu::class, 'id_status');
    }
    public function item_asgn_menu()
    {
        return $this->hasMany(Item_asgn_menu::class, 'id_user');
    }


}
