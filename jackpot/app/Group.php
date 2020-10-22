<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'group_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class,'group_role','group_id','role_id');
    }

    public function addGroup($data)
    {
        $roles = $data['roles'];
        unset($data['roles']);
        $data['type'] = 'other';
        $group = new Group($data);
        $group->save();
        $group->roles()->attach($roles);
        return $group;
    }

    public function updateGroup($id,$data)
    {
        $roles = $data['roles'];
        unset($data['roles']);
        $group = $this->findOrFail($id);
        $group->update($data);
        $group->roles()->sync($roles);
        return [$group];
    }

    public function getCreatedAtAttribute($value)
    {
        $uid = 0;
        if (auth()->check()) $uid = auth()->user()->id;
        $format = setting('time_format', $uid)->value;
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format);
    }
}
