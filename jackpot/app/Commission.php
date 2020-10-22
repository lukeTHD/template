<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    //
    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function prize()
    {
        return $this->belongsTo(GameConfig::class, 'prize_id');
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }
}
