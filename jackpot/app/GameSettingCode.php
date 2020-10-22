<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameSettingCode extends Model
{
    //
    protected $table = 'game_setting_code';
    protected $guarded = [];

    public function games_config()
    {
        return $this->hasMany(GameConfig::class, 'code', 'code');
    }
}
