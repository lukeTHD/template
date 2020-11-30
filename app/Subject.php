<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'subject_id');
    }

    public function messageOne(){
        return $this->hasOne(Message::class, 'subject_id')->latest();
    }

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('h:i d/m/Y');
    }
}
