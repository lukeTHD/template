<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    //
    protected $table = 'vaults';

    protected $guarded = [];

    public function vault_activities()
    {
        return $this->hasMany(VaultActivity::class, 'vault_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_code', 'code');
    }

    public function game_config()
    {
        return $this->belongsTo(GameConfig::class, 'game_config_id');
    }
}
