<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameConfig extends Model
{
    protected $table = 'games_config';

    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_code', 'code');
    }

    public function vaults()
    {
        return $this->hasMany(Vault::class, 'game_config_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'prize_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'prize_id');
    }

}
