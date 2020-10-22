<?php

namespace App\Helpers\Lottery;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Run extends LotteryBase
{
    /**
     * Start Lottery
     * @return array
     */
    public function run()
    {
        try {
            return $this->random();
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
