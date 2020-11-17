<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Subject extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages(){
        return $this->hasMany(Subject::class, 'subject_id');
    }

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
}
