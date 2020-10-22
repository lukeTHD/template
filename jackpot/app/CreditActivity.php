<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditActivity extends Model
{
    //
    protected $table = 'credit_activities';
    protected $guarded = [];

    public function credit()
    {
        return $this->belongsTo(Credit::class, 'credit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
