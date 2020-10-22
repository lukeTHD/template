<?php

namespace App\Repositories\LotteryRost;

interface LotteryRostInterface
{
    public function rost($lottery_id, $game, $numbers);
}
