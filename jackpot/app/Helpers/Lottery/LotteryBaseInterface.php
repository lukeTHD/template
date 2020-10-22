<?php

namespace App\Helpers\Lottery;

interface LotteryBaseInterface
{
    public function init($game);

    public function random();
}
