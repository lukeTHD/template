<?php

namespace App\Repositories\Ticket;

use App\Helpers\Eticket\Major;
use App\Repositories\RepositoriesAbstract;
use App\User;
use App\Vault;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TicketRepository extends RepositoriesAbstract implements TicketInterface
{

    protected $major;
    protected $bookingModel;
    protected $userModel;
    protected $vaultModel;
    protected $gameModel;
    const status_ticket = [
        "create" => "create ",
        "won" => "won",
        "lost" => "lost",
    ];

    const type_ticket = [
        "standard" => "standard"
    ];

    const vault = [
        "type" => [
            "plus" => "plus",
            "minus" => 'minus'
        ]
    ];

    public function __construct(Model $model, Model $bookingModel, Model $userModel, Model $vaultModel, Model $gameModel)
    {
        parent::__construct($model);
        $this->bookingModel = $bookingModel;
        $this->userModel = $userModel;
        $this->vaultModel = $vaultModel;
        $this->gameModel = $gameModel;
        $this->major = new Major();
    }

    /**
     * {@inheritdoc}
     */
    public function postBooking($data, $game, $uid, $currency)
    {
        $flag = false;
        $msg = null;
        DB::beginTransaction();
        try {
            //add booking
//            dd(now("UTC"));die;
            $booking = new $this->bookingModel([
                'created_at' => now(),
                'total_price' => $data['total_price'],
                'total_quantity' => $data['total_quantity'],
                'uid' => $uid
            ]);
            $booking->save();

            $type = $data['type'];


//            $return = $data['tickets'];
            $data['tickets'] = collect($data['tickets'])->map(function ($value) use ($booking, $type, $data, $currency) {
                $value = collect($value)->map(function ($value) {
                    $value = (string)((int)$value);
                    if ($value < 10) $value = "0" . (string)$value;
                    return $value;
                });
                $value['picked'] = json_encode($value);
                $value['booking_id'] = $booking->id;
                $value['price'] = $data['each_ticket_price'];
                $value['type'] = $type;
                $value['currency'] = $currency;
                return $value;
            })->toArray();


//            return $data['tickets'];
            //add ticket for booking
            $picked_at = now();
            $_total_price = 0;
            for ($period = 1; $period <= (int)$data['period']; $period++) {
                foreach ($data['tickets'] as $ticket) {
                    Log::channel('buy_ticket')->notice('buy_ticket:buy:notice', $ticket);
                    if ($period == 1) {
                        $_total_price += (float)$ticket['price'];
                        $this->addTicket($ticket, $game, $uid, $picked_at, true);
                    } else {
                        $this->addTicket($ticket, $game, $uid, $picked_at);
                    }
                }
                $picked_at = $picked_at->addDay();
            }
            $this->addVaultForGame($_total_price, $game, $booking->id);
            // update balance for user
            $this->updateBalanceForUser($data['total_price'], $uid, "buy ticket booking:{" . $booking->id . "}", $currency);
            // sso
            $user = $this->userModel->find($uid);
            // Vu Linh update 20-08
            if (env('APP_ENV') === 'production') $this->major->wallet_buy_ticket((float)$data['total_price'], $currency, 'Buy ticket ' . $user->uid . ' , booking id ' . $booking->id);
//    old ==>        if (env('APP_ENV') === 'production') $this->major->wallet_buy_ticket((float)$data['total_price'], config('constants.currency.eticket'), 'Buy ticket ' . $user->uid . ' , booking id ' . $booking->id);
            DB::commit();
            $flag = true;
            return $flag;

        } catch (\Exception $ex) {
            DB::rollback();
            $msg = $ex;
            $flag = false;
        }
        if (!$flag) {

        }
        return $flag;
    }


    public function updateBalanceForUser($total_price, $uid, $reason, $currency)
    {
        $getBalance = DB::table("credits")->select("value", "id")->where([
            "uid" => $uid,
            "currency" => $currency
        ])->latest()->first();

        $id = DB::table('credits')->insertGetId([
            'uid' => $uid,
            'currency' => $currency,
            'value' => (float)$getBalance->value - (float)$total_price,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Log::channel('credit')->notice('credit:update_balance_user:notice', [
            'uid' => $uid,
            'currency' => $currency,
            'value' => (float)$getBalance->value - (float)$total_price,
            'created_at' => now(),
            'updated_at' => now()
        ]);

//        DB::table("credits")->where(["uid" => $uid, "currency" => config('constants.currency.eticket')])->update([
//            'value' => DB::raw('value - ' . $total_price),
//            "updated_at" => now()
//        ]);

        DB::table("credit_activities")->insert([
            "note" => $reason,
            "uid" => $uid,
            "old_value" => $getBalance->value,
            "value" => $total_price,
            "type" => self::vault['type']['minus'],
            "reason" => $reason,
            "credit_id" => $id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        Log::channel('credit')->notice('credit:update_balance_user:notice', [
            "note" => $reason,
            "uid" => $uid,
            "old_value" => $getBalance->value,
            "value" => $total_price,
            "type" => self::vault['type']['minus'],
            "reason" => $reason,
            "credit_id" => $id
        ]);
        return true;
    }

    public function addVaultForGame($total_price, $game, $booking_id)
    {
        $game = $this->gameModel->where('id', $game->id)->with(['games_config'])->first();
        $before = collect($game['games_config'])->filter(function ($value) {
//            return $value['type'];
            return $value['type'] == config('constants.game_config.type.before');
        });
        foreach ($before as $key => $gameConfig) {
            $value = format_number_money((float)$total_price * (float)$gameConfig['percent'] / 100);
            //get last value of vault
            $lastValue = $this->vaultModel->select("value")->where([
                "game_code" => $game->code,
                'game_config_id' => $gameConfig['id']
            ])->orderBy('created_at', "desc")->first();
            $price = !empty($lastValue) && !empty($lastValue->value) ? $lastValue->value : 0;
            $id = $this->vaultModel->create([
                "game_code" => $game->code,
                'game_config_id' => $gameConfig['id'],
                "value" => $price + $value
            ]);
            Log::channel('crate')->notice('crate:add_amount_to_crate:notice', [
                "game_code" => $game->code,
                'game_config_id' => $gameConfig['id'],
                "value" => $price + $value
            ]);
            //add vault_activities
            DB::table("vault_activities")->insert([
                "note" => "buy ticket booking:{" . $booking_id . "}",
                "game_code" => $game->code,
                "reason" => "buy_ticket",
                "value" => $value,
                "vault_id" => $id->id,
                "type" => self::vault['type']['plus'],
                "created_at" => now()
            ]);
            Log::channel('crate')->notice('crate_activity:add_amount_to_crate:notice', [
                "note" => "buy ticket booking:{" . $booking_id . "}",
                "game_code" => $game->code,
                "reason" => "buy_ticket",
                "value" => $value,
                "vault_id" => $id->id,
                "type" => self::vault['type']['plus']
            ]);
        }

        return true;
    }

    public function addTicket($data, $game, $uid, $picked_at, $is_first_period = false)
    {

        return $this->model->create([
            "booking_id" => $data['booking_id'],
            "game_id" => $game->id,
            "picked" => $data['picked'],
            "price" => $data['price'],
            "status" => self::status_ticket['create'],
            "type" => $data['type'],
            "uid" => $uid,
            "currency" => $data['currency'],
            "picked_at" => $picked_at,
            "is_add_vault" => $is_first_period ? 1 : 0
        ]);
    }

    public function getStatistic($from, $to)
    {
        return $this->model->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
    }

    public function myTickets($request, $is_all = false)
    {
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            $instance = $this->model->where(['uid' => auth_client()['id']]);
            if (!$is_all) $instance->where('status', config('constants.ticket.status.create'));
            if ($request->has('type') && $request->type !== 'all') $instance->where('type', $request->type);
            return $instance
                ->where('picked_at','>=', now('UTC')->startOfDay())->orderBy('picked_at', 'ASC')->paginate(config('constants.pagination.ticket'), ['*'], 'page_t');
        }
        return null;
    }

    public function myTicketsCount()
    {
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            $instance = $this->model->where(['uid' => auth_client()['id']]);
            return $instance->where('picked_at','>=', now('UTC')->startOfDay())->count();
        }
        return null;
    }

    public function ticketNotAddToVault()
    {
        return $this->model->where('picked_at', '>=', now('UTC')->startOfDay())->where('picked_at', '<=', now('UTC')
            ->endOfDay())->where('is_add_vault', config('constants.vault.not_add_to_vault'))->get();
    }

    public function winTickets($is_paginate = false, $request = null)
    {
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            $instance = $this->model->where(['uid' => auth_client()['id'], 'status' => config('constants.ticket.status.success')])->with(['prize', 'lottery']);
            $instance->orderBy('picked_at','ASC');
            if ($is_paginate) {
                if ($request->has('type') && $request->type !== 'all') $instance->where('type', $request->type);
                return $instance->paginate(config('constants.pagination.ticket'), ["*"], "page_w");
            } else
                return $instance->get();
        }
        return null;
    }

    public function winTicketsCount()
    {
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            $instance = $this->model->where(['uid' => auth_client()['id'], 'status' => config('constants.ticket.status.success')])->with(['prize', 'lottery']);
            return $instance->count();
        }
        return null;
    }

    public function seen($id)
    {
        $ticket = $this->model->find($id);
        if ($ticket->uid == auth_client()['id'] && $ticket->status === 'success' && (int)$ticket->is_seen_congratulation === 0) {
            $ticket->update([
                'is_seen_congratulation' => 1
            ]);
            return true;
        }
        return false;
    }

    public function ticketsCongratulation($uid)
    {
        return $this->model->where(['status' => 'success', 'is_seen_congratulation' => 0, 'uid' => auth_client()['id']])->get();
    }

    public function countWinningTickets()
    {
        return $this->model->where('status', 'success')->count();
    }

    public function countJackpotWinners()
    {
        return $this->model->where('prize_id', 1)->count();
    }

    public function totalAmountAwarded()
    {
        // TODO: Implement totalAmountAwarded() method.
        return $this->model->where('status', 'success')->get()->sum('prize_value');
    }
}
