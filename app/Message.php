<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        if($date->isYesterday()){
            return $date->format('h:i d/m/Y');
        }
        return $date->diffForHumans();
    }
}
