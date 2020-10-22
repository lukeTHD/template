<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReward extends Model
{
    //

    protected $table = 'ticket_rewards';
    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function game_reward()
    {
        return $this->belongsTo(GameReward::class, 'game_reward_id');
    }
}
