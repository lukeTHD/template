<?php

namespace App\Repositories\Game;

use Illuminate\Database\Eloquent\Model;

interface GameInterface
{

    public function __construct(Model $model, Model $gameRewardModel, Model $sackModel, Model $gameSettingCodeModel, Model $vaultModel);

    public function getStatistic($from, $to);

    public function addGameRewards($game_id, $rewards);

    public function addSacks($game_id, $sacks);

    public function update($id,array $update);

    public function allGame();

    public function detailGame($game_code);

    public function winning_numbers($game_code, $time_end, $time_start);

    public function winning_numbers_roster($lottery_id, $nowDay);

    public function split_money_buy_ticket(string $game_code, float $amount);

    public function config_reward_after_game(string $game_code);

    public function vault_prize($game_code, $prize);
}
