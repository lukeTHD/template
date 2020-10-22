<?php

namespace App\Helpers\Lottery;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Get extends LotteryBase
{
    /**
     * Get win tickets
     * @return array
     */
    public function getAllTickets($numbers) {
        try {
            $this->load();
            $this->findTickets($numbers);
            return [$this->win_tickets,$this->lose_tickets];
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
