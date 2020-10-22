<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameReward extends Model
{
    use SoftDeletes;

    protected $table = 'game_rewards';

    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function ticket_rewards()
    {
        return $this->hasMany(TicketReward::class, 'game_reward_id');
    }

    public function lottery_activities()
    {
        return $this->hasOne(LotteryActivity::class, 'game_reward_id');
    }
}
