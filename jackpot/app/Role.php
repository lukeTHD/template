<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $guarded = [];

    public function groups() {
        return $this->belongsToMany(Group::class,'group_role','role_id','group_id');
    }
}
