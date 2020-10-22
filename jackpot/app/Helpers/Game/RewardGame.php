<?php


namespace App\Helpers\Game;

use App\Repositories\Commission\CommissionInterface;
use App\Repositories\Game\GameInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\Eticket\Major;
use App\Repositories\User\UserInterface;
use App\Repositories\Credit\CreditInterface;
use Illuminate\Support\Facades\Log;
use App\Repositories\Lottery\LotteryInterface;

class RewardGame
{
    private $game_code;
    private $prize;
    private $winners;
    private $tickets;
    private $gameRep;
    private $detail_game;
    private $detail_after_game;
    private $vault_prize;
    private $prize_id;
    private $major;
    private $period;//ngaày phát thương
    private $URep;
    private $CreditRep;
    private $LotteryRep;
    private $commissionRepository;
    private $money_winner = 0;
    private $money_before_divide_commission = 0;
    private $ratio;
    private $lottery_id;

    public function __construct(GameInterface $GameRep, UserInterface $UserRep, CreditInterface $credit, LotteryInterface $lottery, CommissionInterface $commissionRepository)
    {
        $this->gameRep = $GameRep;
        $this->URep = $UserRep;
        $this->CreditRep = $credit;
        $this->LotteryRep = $lottery;
        $this->commissionRepository = $commissionRepository;
        $this->major = new Major();
        $this->ratio = config('constants.ratio');
    }

    public function init(string $game_code, string $prize, array $winners, array $tickets, $prize_id, $lottery_id, $date = null)
    {
        $this->game_code = $game_code;
        $this->prize = $prize;
        $this->winners = $winners;
        $this->tickets = $tickets;
        $this->prize_id = $prize_id;

        //get info game
        $this->detail_game = $this->gameRep->detailGame($this->game_code);
        //config after game
        $this->detail_after_game = $this->gameRep->config_reward_after_game($this->game_code);
        // last price value of game
        $this->vault_prize = $this->gameRep->vault_prize($this->game_code, $prize);

        $this->money_before_divide_commission = format_number_money($this->vault_prize->vault->value) / count($winners);

        $this->period = !empty($date) ? $date : Carbon::now();

        $this->lottery_id = $lottery_id;
    }

    public function run()
    {

        //check divided
        $check_divide = $this->LotteryRep->check_divided_game_in_date($this->period);
        if (!$check_divide || $check_divide['is_done'] === 1) {
            // begin : old
//            Log::error(json_encode(["function" => "RewardGame Run", $this->game_code, $this->prize, $this->winners,
//                "exception" => "Game chua duoc quay so or game da dc chia thuong truoc do!"]));
//            return ["status" => false, "msg" => "Game đã chia tiền thưởng cho ngày này rồi!",
//                "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            // end : old

            // begin: Vu Linh update 24-08-2020
            Log::channel('crate')->error('lottery:run_reward:error', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'msg' => 'Today already has started lottery.'
            ]);
            return ["status" => false, "msg" => "Today already has started lottery",
                "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            // end: Vu Linh update 24-08-2020
        }
        DB::beginTransaction();
        try {
            //divide commission
            $arrCommisison = [];
            $total_vault_commission = 0;
            foreach ($this->detail_after_game as $key => $value) {
                $amount = format_number_money(floatval($value->percent) * $this->vault_prize->vault->value / 100);
                $arrCommisison[$value->code] = [
                    "percent" => $value->percent,
                    "amount" => $amount,
                    "detail" => $value
                ];
                $total_vault_commission += $amount;
            }

            $still_vault = $this->vault_prize->vault->value - $total_vault_commission;

            //money of each person

            $result_keep_vault = $this->keep_vault($arrCommisison[config("constants.game_config.code.keep_return")]);
            if (!$result_keep_vault['status']) {
                DB::rollBack();
                return ["status" => false, "msg" => "keep_vault error", "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            }

            $result_for_company = $this->for_company($arrCommisison[config("constants.game_config.code.for_company")]);
            if (!$result_for_company['status']) {
                DB::rollBack();
                return ["status" => false, "msg" => "for_company error", "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            }


            $result_affiliator = $this->for_affiliator($arrCommisison[config("constants.game_config.code.for_affiliator")], $this->winners);
            if (!$result_affiliator['status']) {
                DB::rollBack();
                return ["status" => false, "msg" => "for_affiliator error", "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            }

            //

            //check exist affiliator level 2

            if (isset($arrCommisison[config("constants.game_config.code.for_affiliator_2")])) {
                $result_affiliator = $this->for_affiliator_2(
                    $arrCommisison[config("constants.game_config.code.for_affiliator_2")], $this->winners);
                if (!$result_affiliator['status']) {
                    DB::rollBack();
                    return ["status" => false, "msg" => "for_affiliator error", "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
                }
            }


            //still amount
            $result_for_winner = $this->for_winners($still_vault, $this->winners);
            if (!$result_for_winner['status']) {
                DB::rollBack();
                return ["status" => false, "msg" => "for_winners error", "data" => [$this->game_code, $this->prize, $this->winners, Carbon::now()]];
            }

            //update vault game
            $minus_amount_vault = ($this->vault_prize->vault->value) - ($arrCommisison[config("constants.game_config.code.keep_return")]['amount']);
            $this->update_vault($this->game_code, $this->vault_prize->id, $minus_amount_vault);
            DB::commit();
//  old log =>           Log::info(json_encode(["function" => "RewardGame Run", $this->game_code, $this->prize, $this->winners]));
            Log::channel('lottery')->info('lottery:run_reward:success', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'msg' => 'Success.'
            ]);

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('lottery')->error('lottery:run_reward:error:code', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'exception_msg' => $exception->getMessage()
            ]);
// old log =>            Log::error(json_encode(["function" => "RewardGame Run", $this->game_code, $this->prize, $this->winners, "exception" => $exception]));
            return false;
        }
    }

    private function keep_vault($keep_return)
    {
//        var_dump($keep_return);
        //no word
//    old log =>    Log::info(json_encode(["function" => "RewardGame Run => keep_vault", $this->game_code, $this->prize, $this->winners]));
        Log::channel('lottery')->notice('lottery:run_reward(keep_vault):notice', [
            'game_code' => $this->game_code,
            'prize' => $this->prize_id,
            'winners' => $this->winners
        ]);
        return ["status" => true];
    }

    private function for_company($data_company)
    {
        //get ssoID
        $infoCompany = json_decode($data_company['detail']['note'], true);
        $ssoId = $infoCompany['ssoId'];
        $currency = $infoCompany['currency'];
        //divide for company
        if (env("APP_ENV") === "production" && floatval($data_company['amount']) >= 1) {
            $resutl_divide = $this->major->tranfer_to_wallet("TOP", $ssoId, $currency, $data_company['amount'], "divide reward for company");
        } else {
            $resutl_divide = true;
//            $resutl_divide = $this->major->tranfer_to_wallet("ROOT", $ssoId, $currency, 1, "divide reward for company local");
        }

        if (!$resutl_divide) {
            Log::channel('lottery')->error('lottery:run_reward(for_company):error', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'data' => [
                    'ssoId' => $ssoId,
                    'currency' => $currency,
                    'amount' => $data_company['amount']
                ]
            ]);
            return ["status" => false];
        }
        /*     old log =>  Log::info(json_encode(["function" => "RewardGame Run => for_company",
                   $this->game_code, $this->prize,
                   $this->winners,
                   "data" => [$ssoId, $currency, $data_company['amount']]]));*/
        Log::channel('lottery')->info('lottery:run_reward(for_company):success', [
            'game_code' => $this->game_code,
            'prize' => $this->prize_id,
            'winners' => $this->winners,
            'data' => [
                'ssoId' => $ssoId,
                'currency' => $currency,
                'amount' => $data_company['amount']
            ]
        ]);
        return ["status" => true];
    }

    private function for_affiliator($dataAffiliator, $winners)
    {
        /*// từ top chuyển tiền cho root , sau đó cộng tiền trong jackpot cho affiliator

        // chuyen tien cho root
        if (env("APP_ENV") === "production" && $dataAffiliator['amount'] >= 1) {
            // begin: Vu Linh update 20-08
            $infoCompany = json_decode($dataAffiliator['detail']['note'], true);
            $currency = $infoCompany['currency'];
            $result_tranfer_to_affiliator = $this->major->wallet_award_user($dataAffiliator['amount'], $currency, "divide commission for affiliator");
            // end: Vu Linh update 20-08
// old ==>            $result_tranfer_to_affiliator = $this->major->wallet_award_user($dataAffiliator['amount'], "ETI", "divide commission for affiliator");
        } else {
            $result_tranfer_to_affiliator = true;
//            $result_tranfer_to_affiliator = $this->major->wallet_award_user(1, "ETI","divide commission for affiliator test");
        }
        if (!$result_tranfer_to_affiliator) {
            Log::channel('lottery')->error('lottery:run_reward(for_affiliator):error', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'data' => $dataAffiliator
            ]);
            return ["status" => false];
        }*/

        //get affiliator of winner
        // begin: old
        /*$listAffiliatorOfWinner = $this->URep->get_list_affiliator_of_user($winners);
        if (count($listAffiliatorOfWinner) < 1) {
            return ["status" => true];
        }

        foreach ($listAffiliatorOfWinner as $key => $value) {
            $itemInfo = json_decode($value->user_info, true);
            if (!empty($itemInfo['parent_id'])) {
                //update balance for user
                //check exist user in jackpot
                $check_parent_id = $this->URep->check_sso_id($itemInfo['parent_id']);
                if (!empty($check_parent_id)) {
                    //add balance for parent_id
                    //add new balance
                    $value_divide = format_number_money($dataAffiliator['amount'] / count($winners));

                    $this->CreditRep->add_balance_for_user(
                        $value_divide,
                        config('constants.currency.usdt'),
                        "divide affilliate user {" . $value->uid . "}",
                        $check_parent_id->id
                    );
                }
            }
        }*/
        // end: old
        // Vu Linh update 20-08
        $listAffiliatorOfWinner = $this->tickets;
        if (count($listAffiliatorOfWinner) < 1) {
            return ["status" => true];
        }

        foreach ($listAffiliatorOfWinner as $key => $value) {
            $itemInfo = json_decode($value->user->user_info, true);
            $value_divide = format_number_money($dataAffiliator['amount'] / count($winners));
            if (!empty($itemInfo['parent_id'])) {
                //update balance for user
                //check exist user in jackpot

                $check_parent_id = $this->URep->check_sso_id($itemInfo['parent_id']);
                if (empty($check_parent_id)) $check_parent_id = $this->URep->createSsoUser($itemInfo['parent_id']);

                //add balance for parent_id
                //add new balance


                if (!empty($check_parent_id)) {
                    foreach ($this->ratio as $currency => $percent) {
                        $amount_send = $value_divide * $percent / 100;
                        /*$this->CreditRep->add_balance_for_user(
                            $amount_send,
                            $currency,
                            "reward winner " . $this->game_code . ", prize: " . $this->prize . " {" . $value->user->uid . "}",
                            $check_parent_id->id
                        );*/
                        $this->commissionRepository->addCommission([
                            'ticket_id' => $value->id,
                            'from_id' => $value->user->id,
                            'uid' => $check_parent_id->id,
                            'prize_id' => $this->prize_id,
                            'percent' => $dataAffiliator['percent'],
                            'amount' => $amount_send,
                            'currency' => $currency,
                            'lottery_id' => $this->lottery_id,
                            'note' => [
                                'level' => 1,
                                'amount_ori' => $this->money_before_divide_commission
                            ]
                        ]);
                    }
                }

                /*if (!$resutl_tranfer) {
                    Log::channel('lottery')->error('lottery:run_reward(for_affiliator):error', [
                        'game_code' => $this->game_code,
                        'prize' => $this->prize_id,
                        'winners' => $this->winners,
                        'data' => $value
                    ]);
                    return ["status" => false];
                }*/

                // Add commission
            } else {
                foreach ($this->ratio as $currency => $percent) {
                    $amount_send = $value_divide * $percent / 100;
                    $this->commissionRepository->addCommissionTemp([
                        'ticket_id' => $value->id,
                        'from_id' => $value->user->id,
                        'prize_id' => $this->prize_id,
                        'percent' => $dataAffiliator['percent'],
                        'amount' => $amount_send,
                        'currency' => $currency,
                        'lottery_id' => $this->lottery_id,
                        'note' => [
                            'level' => 1,
                            'amount_ori' => $this->money_before_divide_commission
                        ]
                    ]);
                }
            }
        }
        /* old log => Log::info(json_encode(["function" => "RewardGame Run => for_affiliator",
            $this->game_code, $this->prize,
            $this->winners,
            "data" => [$dataAffiliator, $winners]]));*/
        Log::channel('lottery')->info('lottery:run_reward(for_affiliator):success', [
            'game_code' => $this->game_code,
            'prize' => $this->prize_id,
            'winners' => $this->winners,
            'data' => $dataAffiliator
        ]);
        return ["status" => true];
    }

    public function for_affiliator_2($dataAffiliator2, $winners)
    {
        /*if (env("APP_ENV") === "production" && $dataAffiliator2['amount'] >= 1) {
            // begin: Vu Linh update 20-08
            $infoCompany = json_decode($dataAffiliator2['detail']['note'], true);
            $currency = $infoCompany['currency'];
            $result_tranfer_to_affiliator = $this->major->wallet_award_user($dataAffiliator2['amount'], $currency, "divide commission for affiliator");
            // end Vu Linh update
// old ==>            $result_tranfer_to_affiliator = $this->major->wallet_award_user($dataAffiliator2['amount'], "ETI", "divide commission for affiliator");
        } else {
            $result_tranfer_to_affiliator = true;
//            $result_tranfer_to_affiliator = $this->major->wallet_award_user(1, "ETI","divide commission for affiliator test");
        }
        if (!$result_tranfer_to_affiliator) {
            Log::channel('lottery')->error('lottery:run_reward(for_affiliator_2):error', [
                'game_code' => $this->game_code,
                'prize' => $this->prize_id,
                'winners' => $this->winners,
                'data' => $dataAffiliator2
            ]);
            return ["status" => false];
        }*/


        //get affiliator of winner

        /*$listAffiliatorOfWinner = $this->URep->get_list_affiliator_of_user($winners);
        if (count($listAffiliatorOfWinner) < 1) {
            return ["status" => true];
        }

        foreach ($listAffiliatorOfWinner as $key => $value) {
            $itemInfo = json_decode($value->user_info, true);
            if (!empty($itemInfo['parent_id'])) {
                // check parent
                $check_parent = $this->URep->check_sso_id($itemInfo['parent_id']);
                $json_info_parent = json_decode($check_parent->user_info) ? json_decode($check_parent->user_info, true) : [];
                //check parent 2
                if (!empty($json_info_parent) && isset($json_info_parent['parent_id']) && !empty($json_info_parent['parent_id'])) {
                    $check_parent_2 = $this->URep->check_sso_id($json_info_parent['parent_id']);
                    if (!empty($check_parent_2)) {
                        $value_divide = format_number_money($dataAffiliator2['amount'] / count($winners));
                        $this->CreditRep->add_balance_for_user(
                            $value_divide,
                            config('constants.currency.usdt'),
                            "divide affilliate user (level=2) {" . $value->uid . "}",
                            $check_parent_2->id
                        );
                    }
                }

            }
        }*/

        // Vu Linh update 20-08

        $listAffiliatorOfWinner = $this->tickets;
        if (count($listAffiliatorOfWinner) < 1) {
            return ["status" => true];
        }

        foreach ($listAffiliatorOfWinner as $key => $value) {
            $itemInfo = json_decode($value->user->user_info, true);
            $value_divide = format_number_money($dataAffiliator2['amount'] / count($winners));
            $has_parent_2 = false;
            $check_parent = null;
            if (!empty($itemInfo['parent_id'])) {
                // check parent
                $check_parent = $this->URep->check_sso_id($itemInfo['parent_id']);
                $json_info_parent = json_decode($check_parent->user_info) ? json_decode($check_parent->user_info, true) : [];
                //check parent 2
                if (!empty($json_info_parent) && isset($json_info_parent['parent_id']) && !empty($json_info_parent['parent_id'])) {
                    $check_parent_2 = $this->URep->check_sso_id($json_info_parent['parent_id']);
                    if (!empty($check_parent_2)) {
                        $has_parent_2 = true;
//                        $this->CreditRep->add_balance_for_user(
//                            $value_divide,
//                            $value->currency,
//                            "divide affilliate user (level=2) {" . $value->user->uid . "}",
//                            $check_parent_2->id
//                        );

                        foreach ($this->ratio as $currency => $percent) {
                            $amount_send = $value_divide * $percent / 100;
                            /*$this->CreditRep->add_balance_for_user(
                                $amount_send,
                                $currency,
                                "reward winner " . $this->game_code . ", prize: " . $this->prize . " {" . $value->user->uid . "}",
                                $check_parent_2->id
                            );*/
                            $this->commissionRepository->addCommission([
                                'ticket_id' => $value->id,
                                'from_id' => $value->user->id,
                                'uid' => $check_parent_2->id,
                                'prize_id' => $this->prize_id,
                                'percent' => $dataAffiliator2['percent'],
                                'amount' => $amount_send,
                                'currency' => $currency,
                                'lottery_id' => $this->lottery_id,
                                'note' => [
                                    'level' => 2,
                                    'amount_ori' => $this->money_before_divide_commission
                                ]
                            ]);
                            /*if (env("APP_ENV") === "production") {
                                $resutl_tranfer = $this->major->wallet_award_user(
                                    $amount_send,
                                    $currency,
                                    "Total money reward of winner - sso_id{" . $value->user->uid . "} " . Carbon::now()->toDateTimeString()
                                );
                                if (!$resutl_tranfer) {
                                    $resutl_tranfer = false;
                                    break;
                                }
                            } else {
                                $resutl_tranfer = true;
                            }*/
                        }

                        /*if (!$resutl_tranfer) {
                            Log::channel('lottery')->error('lottery:run_reward(for_affiliator_2):error', [
                                'game_code' => $this->game_code,
                                'prize' => $this->prize_id,
                                'winners' => $this->winners,
                                'data' => $value
                            ]);
                            return ["status" => false];
                        }*/

                        // Add commission


                    }
                }

            }
            if (!$has_parent_2) {
                foreach ($this->ratio as $currency => $percent) {
                    $amount_send = $value_divide * $percent / 100;
                    $this->commissionRepository->addCommissionTemp([
                        'ticket_id' => $value->id,
                        'from_id' => $value->user->id,
                        'prize_id' => $this->prize_id,
                        'percent' => $dataAffiliator2['percent'],
                        'amount' => $amount_send,
                        'currency' => $currency,
                        'lottery_id' => $this->lottery_id,
                        'note' => [
                            'level' => 2,
                            'amount_ori' => $this->money_before_divide_commission,
                            'parent_of' => $check_parent ? $check_parent->uid : null,
                            'parent_of_ori' => $value->user->uid
                        ]
                    ]);
                }
            }
        }

        Log::channel('lottery')->info('lottery:run_reward(for_affiliator_2):success', [
            'game_code' => $this->game_code,
            'prize' => $this->prize_id,
            'winners' => $this->winners,
            'data' => $dataAffiliator2
        ]);
        /* old log => Log::info(json_encode(["function" => "RewardGame Run => for_affiliator_2",
             $this->game_code, $this->prize,
             $this->winners,
             "data" => [$dataAffiliator2, $winners]]));*/
        return ["status" => true];

    }


    private function for_winners($amount, $winners)
    {
        // begin: old
        /*//tranfer amount from TOP to ROOT
        if (env("APP_ENV") === "production" && $amount >= 1) {
            $resutl_tranfer = $this->major->wallet_award_user(
                format_number_money($amount),
                config('constants.currency.usdt'),
                "Total money reward of winners - " . Carbon::now()->toDateTimeString()
            );
        } else {
            $resutl_tranfer = true;
//            $resutl_tranfer = $this->major->wallet_award_user(
//                1,
//                config('constants.currency.eticket'),
//                "Total money reward of winners - " . Carbon::now()->toDateTimeString()
//            );

        if (!$resutl_tranfer) {
                    return ["status" => false];
                }
        }*/
        // end: old


        // add balance for winnner
        $money_each_person = format_number_money($amount / count($this->winners));
        // begin: old
        /*foreach ($winners as $key => $value) {
            $check_winner = $this->URep->check_sso_id($value);
            if (!empty($check_winner)) {
                $this->CreditRep->add_balance_for_user(
                    $money_each_person,
                    config('constants.currency.usdt'),
                    "reward winner " . $this->game_code . ", prize: " . $this->prize . " {" . $value . "}",
                    $check_winner->id
                );
            }
//            dd($check_winner);

        }*/
        // end: old
        // begin: Vu Linh update 20-08
        if (count($this->tickets) > 0) {
            foreach ($this->tickets as $key => $value) {
                $check_winner = $this->URep->check_sso_id($value->user->uid);
                if (!empty($check_winner)) {
                    $this->CreditRep->add_balance_for_user(
                        $money_each_person,
//                        $value->currency,
                        config('constants.currency.usdt'),
                        "reward winner " . $this->game_code . ", prize: " . $this->prize . " {" . $value->user->uid . "}",
                        $check_winner->id
                    );

                    // begin: Vu Linh update 21-08
                    ///tranfer amount from TOP to ROOT
                    if (env("APP_ENV") === "production") { // !!   && $money_each_person >= 1
                        $rounded_number = format_number_money($money_each_person);
                        $resutl_tranfer = $this->major->wallet_award_user(
                            $rounded_number,
//                            $value->currency,
                            config('constants.currency.usdt'),
                            "Total money reward of winner - sso_id{" . $value->user->uid . "} " . Carbon::now()->toDateTimeString()
                        );
                    } else {
                        $resutl_tranfer = true;
                    }
                    if (!$resutl_tranfer) {
                        Log::channel('lottery')->error('lottery:run_reward(for_winners):error', [
                            'game_code' => $this->game_code,
                            'prize' => $this->prize_id,
                            'winners' => $this->winners,
                            'data' => $value
                        ]);
                        return ["status" => false];
                    }
                    // end: Vu Linh update 21-08
                }
            }
        }

        // end: Vu Linh update 20-08
        $this->money_winner = $money_each_person;
        /* old log => Log::info(json_encode(["function" => "RewardGame Run => for_winners",
            $this->game_code, $this->prize,
            $this->winners,
            "data" => [$amount, $winners, $money_each_person]]));*/
        Log::channel('lottery')->info('lottery:run_reward(for_winners):success', [
            'game_code' => $this->game_code,
            'prize' => $this->prize_id,
            'winners' => $this->winners,
        ]);
        return ["status" => true];
    }

    private function update_vault($game_code, $prize, $amount)
    {
        $this->gameRep->update_vault_reward($game_code, $prize, $amount);
        return ["status" => true];
    }

    public function getMoneyWinner()
    {
        return $this->money_winner;
    }
}
