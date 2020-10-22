<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryActivity extends Model
{
    use SoftDeletes;

    protected $table = 'lottery_activities';
    protected $guarded = [];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function game_reward()
    {
        return $this->belongsTo(GameReward::class, 'game_reward_id');
    }
}
