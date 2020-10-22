<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaultActivity extends Model
{
    //
    protected $table = 'vault_activities';

    protected $guarded = [];

    public function vault()
    {
        return $this->belongsTo(Vault::class, 'vault_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_code', 'code');
    }
}
