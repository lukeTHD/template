<?php

namespace App\Jackpot;

use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Game;

abstract class Algorithm
{

    protected $numbersOfTickets = [];
    protected $winningTicketsTemp = [];
    protected $winningTickets = [];
    protected $loseTickets = [];
    protected $rewards = [];
    protected $rewardsId = [];
    protected $random = [];
    protected $start = 1;
    protected $number_pick;
    protected $number_max;
    protected $rewardTimes = [];
    protected $totalPrize = 0;
    protected $game_code;
    protected $canRun = true;
    protected $game;

    // Handle
    abstract public function run($game);

    // Random numbers from $number_pick to $number_max
    public function random($number_pick, $number_max)
    {
        $this->number_pick = $number_pick;
        $this->number_max = $number_max;
        $number_list = range($this->start, $number_max);
        $numbers = [];
        for ($i = 1; $i <= $number_pick; $i++) {
            $number =(string) array_rand($number_list);
            if($number < 10) $number = "0"."$number";
            $numbers[] = $number;
            unset($number_list[$number]);
        }
        $numbers = ["01", "02", "03", "04", "05"];
        $this->random = $numbers;
        return $numbers;
    }

    public function init($game)
    {
        $game_id = $game->id;
        $vault = vault($this->game_code)->value;

        $instance = Ticket::where(['game_id' => $game_id, 'status' => 'create'])->whereDate('created_at', Carbon::today());
        if (!$instance->exists()) {
            $this->canRun = false;
            return null;
        };

        $tickets = $instance->get()->toArray();

        $this->rewards = collect($game->game_rewards->toArray())->mapWithKeys(function ($value) use ($vault) {
            $share = $value['share_new'] + $value['share_company'] + $value['share_up'] + $value['share_level_2'];
            $prize = ($vault * $value['value_percent'] / 100);
            $value['prize'] = $prize * (100 - $share) / 100;
            $value['share'] = $share;
            $value['share_new_percent'] = $value['share_new'];
            $value['share_company_percent'] = $value['share_company'];
            $value['share_up_percent'] = $value['share_up'];
            $value['share_level_2_percent'] = $value['share_level_2'];
            $value['share_new_value'] = $prize * $value['share_new'] / 100;
            $value['share_company_value'] = $prize * $value['share_company'] / 100;
            $value['share_up_value'] = $prize * $value['share_up'] / 100;
            $value['share_level_2_value'] = $prize * $value['share_level_2'] / 100;
            $this->rewardsId[$value['id']] = $value;
            return [$value['number'] => $value];
        })->toArray();
//        ->whereDate('created_at', Carbon::today()->subDay())

        return collect($tickets)->map(function ($value) {
            $picked = $value['picked'];

            $this->numbersOfTickets[] = [
                'ticket_id' => $value['id'],
                'picked' => $value['picked'],
                'uid' => $value['uid']
            ];

            return $value;
        })->toArray();
    }

    public function getNumbersOfTickets()
    {
        return $this->numbersOfTickets;
    }

    public function getReward($number)
    {
        return isset($this->rewards[$number]) ? $this->rewards[$number] : null;
    }

    public function getRewardById($id)
    {
        return isset($this->rewardsId[$id]) ? $this->rewardsId[$id] : null;
    }

    public function addWinningTicketTemp($ticket, $reward, $same)
    {
        $rewardId = $reward['id'];
        $this->rewardTimes[$rewardId] = isset($this->rewardTimes[$rewardId]) ? ++$this->rewardTimes[$rewardId] : 1;
        $this->winningTicketsTemp[$ticket['ticket_id']] = [
            'ticket_id' => $ticket['ticket_id'],
            'picked' => $ticket['picked'],
            'numbers_winning' => $this->random,
            'reward' => $reward,
            'uid' => $ticket['uid'],
            'same' => $same,
            'share_new_percent' => $reward['share_new_percent'],
            'share_company_percent' => $reward['share_company_percent'],
            'share_up_percent' => $reward['share_up_percent'],
            'share_level_2_percent' => $reward['share_level_2_percent'],
            'share_new_value' => $reward['share_new_value'],
            'share_company_value' => $reward['share_company_value'],
            'share_up_value' => $reward['share_up_value'],
            'share_level_2_value' => $reward['share_level_2_value'],
        ];

//        $value['share_new_percent'] = $value['share_new'];
//        $value['share_company_percent'] = $value['share_company'];
//        $value['share_up_percent'] = $value['share_up'];
//        $value['share_level_2_percent'] = $value['share_level_2'];
//        $value['share_new_value'] = $prize * $value['share_new'] / 100;
//        $value['share_company_value'] = $prize * $value['share_company'] / 100;
//        $value['share_up_value'] = $prize * $value['share_up'] / 100;
//        $value['share_level_2_value'] = $prize * $value['share_level_2'] / 100;
    }

    public function addWinningTicket($ticket)
    {
        $this->winningTickets[] = $ticket;
    }

    public function addLoseTicket($ticket)
    {
        $ticket['numbers_winning'] = $this->random;
        $this->loseTickets[] = $ticket;
    }

    public function compare($numbers)
    {
        $diff = array_diff($numbers, $this->random);
        return $this->number_pick - count($diff);
    }
}
