<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users(){
        return $this->hasMany(User::class, 'group_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'group_role', 'group_id', 'role_id');
    }
}

