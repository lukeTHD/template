<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

    public function game_rewards()
    {
        return $this->hasMany(GameReward::class, 'game_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'game_id');
    }

    public function games_config()
    {
        return $this->hasMany(GameConfig::class, 'game_code', 'code');
    }

    public function sacks()
    {
        return $this->hasMany(Sack::class, 'game_id');
    }

    public function vaults()
    {
        return $this->hasMany(Vault::class, 'game_code', 'code');
    }

    public function vault_activities()
    {
        return $this->hasMany(VaultActivity::class, 'game_code', 'code');
    }

    public function addGame($data)
    {
        $rewards = $data['rewards'];
        $sacks = null;
        if (isset($data['sacks'])) $sacks = $data['sacks'];
        unset($data['rewards']);
        unset($data['sacks']);
        $data['end_time'] = Carbon::createFromFormat('H:i:s', $data['roll_time'])->subMinutes(5);
        $data['created_id'] = auth()->user()->id;
        $game = new Game($data);
        $game->save();
        $this->addGameRewards($game->id, $rewards);
        if ($sacks) $this->addSacks($game->id, $sacks);
        return [$game];
    }

    public function updateGame($id, $data)
    {
        $rewards = $data['rewards'];
        if (isset($data['sacks'])) $sacks = $data['sacks'];
        unset($data['rewards']);
        unset($data['sacks']);
        $data['end_time'] = Carbon::createFromFormat('H:i:s', $data['roll_time'])->subMinutes(5);
        $data['updated_id'] = auth()->user()->id;
        $game = $this->findOrFail($id);
        $game->game_rewards()->delete();
        $game->sacks()->delete();
        $game->update($data);
        $this->addGameRewards($id, $rewards);
        if (isset($data['sacks'])) $this->addSacks($id, $sacks);
        return [$game];
    }

    public function addGameRewards($game_id, $rewards)
    {
        $data = collect($rewards)->filter(function ($value, $key) {
            return $value['name'] && $value['value_percent'] >= 0;
        })->map(function ($value, $key) use ($game_id) {
            $value['game_id'] = $game_id;
            $value['created_at'] = now();
            $value['updated_at'] = now();
            return $value;
        })->toArray();

        GameReward::insert($data);
    }

    public function addSacks($game_id, $sacks)
    {
        $data = collect($sacks)->map(function ($value, $key) use ($game_id) {
            $_value = $value;
            $value = [];
            $value['game_id'] = $game_id;
            $value['value'] = $_value;
            $value['created_at'] = now();
            $value['updated_at'] = now();
            return $value;
        })->toArray();
        Sack::insert($data);
    }

    public function getCreatedAtAttribute($value)
    {
        $uid = 0;
        if (auth()->check()) $uid = auth()->user()->id;
        $format = setting('time_format', $uid)->value;
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format);
    }
}
