<?php

namespace App\Jackpot;

use App\Credit;
use App\Lottery;
use App\LotteryActivity;
use App\Repositories\Lottery\LotteryInterface;
use App\Repositories\LotteryRost\LotteryRostInterface;
use App\Ticket;
use App\User;
use App\Vault;
use App\VaultActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Game;

class Random extends Algorithm
{

    public function run($game)
    {
        $this->game = $game;
        $number_pick = $game->number_pick;
        $number_max = $game->number_max;
        $game_code = $game->code;
        $this->game_code = $game_code;
        // Random array numbers
        $this->random($number_pick, $number_max);
        $this->init($game);
        if ($this->canRun) {
            $this->handleTickets();
            if (setting('jackpot_type')->value === 'auto') {
                $this->handlePrize();
                $this->handleDatabase();
            } else {
                return [$this->winningTicketsTemp, $this->loseTickets];
            }
        }
        return [$this->winningTickets, $this->loseTickets];
    }

    public function handleTickets()
    {
        $numbersOfTickets = $this->getNumbersOfTickets();
        foreach ($numbersOfTickets as $numbersOfTicket) {
            $same = $this->compare($numbersOfTicket['picked']);
            if ($reward = $this->getReward($same)) {
                $this->addWinningTicketTemp($numbersOfTicket, $reward, $same);
            } else {
                $format = $numbersOfTicket;
                $format['same'] = $same;
                $this->addLoseTicket($format);
            }
        }
    }

    public function handlePrize()
    {
        $winingTicketsTemp = $this->winningTicketsTemp;
        foreach ($winingTicketsTemp as $ticket_id => $winingTicketTemp) {
            $rewardId = $winingTicketTemp['reward']['id'];
            $prizeForEachTicket = $this->getRewardById($rewardId)['prize'] / $this->rewardTimes[$rewardId];
            $winingTicketTemp['prize'] = $prizeForEachTicket;
            $this->addWinningTicket($winingTicketTemp);
        }
    }

    public function handleDatabase()
    {
        $this->updateVault();
    }

    public function updateVault()
    {
        if ($this->insertLotteryActivities()) {
        }
//            DB::beginTransaction();
//            try {
//                $money = (float)vault($this->game_code)->value - (float)$this->totalPrize;
//                $instance = Vault::where('game_code', $this->game_code);
//                $instance->update([
//                    'value' => $money
//                ]);
//                VaultActivity::create([
//                    'vault_id' => $instance->first()->id,
//                    'value' => (float)$this->totalPrize,
//                    'type' => 'minus',
//                    'reason' => 'lottery',
//                    'note' => 'lottery',
//                    'created_at' => now()
//                ]);
//                DB::commit();
//                return true;
//            } catch (\Exception $ex) {
//                DB::rollback();
//                throw new $ex;
//            }
//        }
    }

    public function insertLotteryActivities()
    {
        if ($lottery_id = $this->insertLottery()) {

            DB::beginTransaction();
            try {
                $insertWinningTickets = [];
                $insertLoseTickets = [];
                // handle winning tickets
                if ($this->winningTickets && count($this->winningTickets) > 0) {
                    $insertWinningTickets = [];
                    $idsWinningTickets = [];
                    foreach ($this->winningTickets as $winningTicket) {
                        $idsWinningTickets[] = $winningTicket['ticket_id'];
                        $this->totalPrize += $winningTicket['prize'];
                        $insertWinningTickets[] = [
                            'lottery_id' => $lottery_id,
                            'ticket_id' => $winningTicket['ticket_id'],
                            'game_reward_id' => $winningTicket['reward']['id'],
                            'value' => $winningTicket['prize'],
                            'share_new_percent' => $winningTicket['share_new_percent'],
                            'share_company_percent' => $winningTicket['share_company_percent'],
                            'share_up_percent' => $winningTicket['share_up_percent'],
                            'share_level_2_percent' => $winningTicket['share_level_2_percent'],
                            'share_new_value' => $winningTicket['share_new_value'],
                            'share_company_value' => $winningTicket['share_company_value'],
                            'share_up_value' => $winningTicket['share_up_value'],
                            'share_level_2_value' => $winningTicket['share_level_2_value'],
                            'is_win' => 1
//                            'created_at' => now()
                        ];

                        $note = 'Win ticket(' . $winningTicket['ticket_id'] . ')(reward: (' . $winningTicket['reward']['id'] . ')) at lottery id : ' . $lottery_id . ' , prize:  ' . $winningTicket['prize'];
// update
//                        Credit::updateCredit($winningTicket['uid'], $winningTicket['prize'], 'plus', 'win_ticket', $note);
                    }
                    Ticket::whereIn('id', $idsWinningTickets)->update(['status' => 'won']);
                }
                // handle lost tickets

                if ($this->loseTickets && count($this->loseTickets) > 0) {
                    $idsLostTickets = [];
                    foreach ($this->loseTickets as $loseTicket) {
                        $idsLostTickets[] = $loseTicket['ticket_id'];
                        $insertLoseTickets[] = [
                            'lottery_id' => $lottery_id,
                            'ticket_id' => $loseTicket['ticket_id'],
                            'game_reward_id' => null,
                            'value' => 0,
                            'share_new_percent' => null,
                            'share_company_percent' => null,
                            'share_up_percent' => null,
                            'share_level_2_percent' => null,
                            'share_new_value' => null,
                            'share_company_value' => null,
                            'share_up_value' => null,
                            'share_level_2_value' => null,
                            'is_win' => 0
                        ];
                    }
                    Ticket::whereIn('id', $idsLostTickets)->update(['status' => 'lost']);
                }

                $insertLotteryActivities = array_merge($insertWinningTickets, $insertLoseTickets);
//                dd($insertLotteryActivities);
                LotteryActivity::insert($insertLotteryActivities);
//
                DB::commit();
                return true;
            } catch (\Exception $ex) {
                DB::rollback();
                throw new $ex;
            }

        }
        return false;
    }

    public function insertLottery()
    {
        DB::beginTransaction();
        try {

            $lottery = app(LotteryInterface::class)->create([
                'numbers' => json_encode($this->random),
                'game_code' => $this->game_code,
                'created_at' => now()
            ]);

            app(LotteryRostInterface::class)->rost($lottery->id, $this->game, $this->random);

            DB::commit();
            return $lottery->id;
        } catch (\Exception $ex) {
            DB::rollback();
            throw new $ex;
        }
    }
}
