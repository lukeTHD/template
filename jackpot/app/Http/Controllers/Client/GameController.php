<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\MailBuy;
use App\Repositories\Credit\CreditInterface;
use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Vault;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Validator;

class GameController extends Controller
{
    protected $GRep;
    protected $TRep;
    protected $TicketRep;

    public function __construct(GameInterface $repository, CreditInterface $credit, TicketInterface $ticket)
    {
        $this->GRep = $repository;
        $this->TRep = $credit;
        $this->TicketRep = $ticket;
    }

    const default_game_choose_number = 5;
    const default_game_max_number = 36;

    public function index($game_code = "")
    {
//        echo mt_rand(1, 36)." ";die;
        if (empty($game_code)) {
            return abort(404);
        }
        $detailGame = $this->GRep->detailGame($game_code);

        $detailGame['value'] = Vault::where('game_code', $game_code)->orderBy('value', 'DESC')->first()->value;

        if (empty($detailGame)) {
            return abort(404);
        }
//        dd($detailGame);
        $nowDay = Carbon::now('UTC');
//        dd($nowDay);
        $time_end = $nowDay->toDateString() . " " . $detailGame->end_time;
        $time_start = $nowDay->toDateString() . " " . $detailGame->start_time;
        $detailGame->start_time = $time_start;
        $detailGame->end_time = $time_end;
        $flag = true;
        if ($nowDay->gt($time_end)) {
            $flag = false;
        }
        $checkExistWinNumber = $this->getWinNumberGame($game_code);
//        dd($checkExistWinNumber);
        //old number jackpot
        $oldNumberJackpot = $this->number_ticket_old($game_code) ? $this->number_ticket_old($game_code) : (object)['numbers' => []];
        $oldNumberJackpot = !empty($oldNumberJackpot) ? $oldNumberJackpot : (object)["id" => "", "numbers" => []];
//        dd([$oldNumberJackpot]);
        return view("client.game.index", [
            "game" => $detailGame,
            "flag" => $flag,
            "WinNumber" => $checkExistWinNumber,
            "oldNumberJackpot" => $oldNumberJackpot
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @description
     * 1: validate data buy
     * 2: check exist,status,end_time for game
     * 3: count ticket and total price
     * 4:  check balance of user
     */
    public function buyTicket(Request $request)
    {
        DB::beginTransaction();
        try {
//        echo $this->adjust_the_convolution(3,34);die;
            $param = $request->all();
            $param['ticket_number'] = json_decode($param['ticket_number'], true);
            $game_choose_number = isset($param['game_choose_number']) ? intval($param['game_choose_number']) : self::default_game_choose_number;
            $game_max_number = isset($param['game_max_number']) ? intval($param['game_max_number']) : self::default_game_max_number;
            $condition = [
                "game_code" => "required",
                "ticket_amount" => "required",
                "ticket_number" => "required|array|min:1",
                "ticket_number.*" => "required|size:" . $game_choose_number,
                "ticket_number.*.*" => "required|numeric|min:1|max:" . $game_max_number,
                "type" => "required|in:standard,4,3",
                "period" => "required|in:1,7,14,28",
                "currency" => "required|in:ETI,EUSDT"
            ];
            //1
            $validator = Validator::make($param, $condition);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }
            //2
            $checkGame = $this->GRep->detailGame($param['game_code']);
            if (empty($checkGame)) {
                return redirect()->back()->withErrors(["error" => "The game is not available !"]);
            }
//        echo $this->adjust_the_convolution($checkGame->number_pick - 4, $checkGame->number_max - 4)."-";
//        echo ($this->adjust_the_convolution($checkGame->number_pick - 3, $checkGame->number_max - 3));die;
            $nowDay = Carbon::now('UTC');
            $time_end = $nowDay->toDateString() . " " . $checkGame->end_time;
            if ($nowDay->gt($time_end)) {
                return redirect()->back()->withErrors(["error" => "Overtime !"]);
                die;
            }
            $total_price = 0;
            $is_standard = true;
            if ($param['type'] === config('constants.ticket.type.standard')) {
                $total_price = count($param['ticket_number']) * $checkGame->price;
            } else {
                $is_standard = false;
                $total_price = ($this->adjust_the_convolution($checkGame->number_pick - (int)$param['type'], $checkGame->number_max - (int)$param['type'])) * $checkGame->price * count($param['ticket_number']);
            }
            $each_ticket_price = $is_standard ? $total_price / count($param['ticket_number']) : $total_price;
            $total_price = $total_price * $param['period'];
            if ($request->has('total_price') && $request->total_price) {
                if ((float)$request->total_price !== (float)$total_price) {
                    return redirect()->back()->withErrors(["error" => __('label.has_error')]);
                }
            }
            //4
//        dd($total_price);
//        dd(session("data_client"));
            $check_balance = $this->TRep->getBalanceById(session("data_client")['id'], $request->currency);
            if ($check_balance->value < $total_price) {
                return redirect()->back()->withErrors(["error" => "Current amount is not enough!"]);
            }

            $dataAddBooking = [
                "total_price" => $total_price,
                "total_quantity" => $param['ticket_amount'],
                "tickets" => $param['ticket_number'],
                "type" => isset($param['type']) ? $param['type'] : config('constants.ticket.type.standard'),
                "period" => $param['period'],
                "each_ticket_price" => $each_ticket_price
            ];
            $result_booking = $this->TicketRep->postBooking($dataAddBooking, $checkGame, session("data_client")['id'], $request->currency);
            /*$dataMail = [
                "display_name" => "LUCA MORIT",
                "status" => "bought",
                "total_price" => $total_price,
                "game_name" => $checkGame->name,
                "price" => $checkGame->price,
                "amount" => $param['ticket_amount'],
                "ROTATE_TIME" => $checkGame->end_time,
                "GAME_CODE" => $checkGame->code,
                "TOTAL_VAULT" => $checkGame->value
            ];

            Mail::to(session("data_client")->email)->send(new MailBuy($dataMail));*/
            DB::commit();
            return redirect()->route('client.dashboard.index')->with(['message' => __('label.buy_success')]);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new $exception;
        }
    }

    public function buySuccess()
    {
        return view("client.game.buySuccess");
    }

    public function rost($game_code)
    {
        $checkGame = $this->GRep->detailGame($game_code);
        if (empty($checkGame)) {
            return response()->json(["status" => false, "msg" => "Current game is not used!"]);
        }
        $nowDay = Carbon::now('UTC');
        $time_end = $nowDay->toDateString() . " " . $checkGame->end_time;
        $tomorrowDay = Carbon::now('UTC')->addDay(1);
        $time_start = $tomorrowDay->toDateString() . " " . $checkGame->start_time;
        if ($nowDay->lt($time_end) || $nowDay->gt($time_start)) {
            return response()->json(["status" => false, "msg" => "out of time dial!"]);
        }
        //get number jackpot
        $checkExistWinNumber = $this->getWinNumberGame($game_code);
        if (!$checkExistWinNumber['status']) {
            return response()->json(["status" => true, "msg" => "success", "data" => []]);
        }
        $arrPcik = [];
        foreach ($checkExistWinNumber['data']['arr_win_number'] as $key => $value) {
            array_push($arrPcik, $value->value);
        }
        return response()->json(["status" => true, "msg" => "success", "data" => $arrPcik]);
    }

    private function getWinNumberGame($game_code)
    {
        $nowDay = Carbon::now('UTC');
        $dayStartDate = $nowDay->startOfDay()->format('Y-m-d H:i:s');
        $dayEndDate = $nowDay->endOfDay()->format('Y-m-d H:i:s');
        //get number jackpot
        $checkExistWinNumber = $this->GRep->winning_numbers($game_code, $dayStartDate, $dayEndDate);
        if (!$checkExistWinNumber) {
            return ["status" => false];
        }
        //get array number win
        $arrNumberWin = null;
        $arrNumberWin = $this->GRep->winning_numbers_roster($checkExistWinNumber->id, Carbon::now('UTC')->toTimeString());
        return ["status" => true, "data" => [
            "win_number" => $checkExistWinNumber,
            "arr_win_number" => $arrNumberWin
        ]];
    }

    public function rules()
    {
        echo 'rules';
        die;
    }

    function tinhGiaithua($n)
    {
        $giai_thua = 1;
        if ($n == 0 || $n == 1) {
            return $giai_thua;
        } else {
            for ($i = 2; $i <= $n; $i++) {
                $giai_thua *= $i;
            }
            return $giai_thua;
        }
    }

    function adjust_the_convolution($k, $n)
    {
        return $this->tinhGiaithua($n) / $this->tinhGiaithua($n - $k);
    }

    private function number_ticket_old($game_code)
    {
        $nowDay = Carbon::now('UTC')->subDay();
        $dayStartDate = $nowDay->startOfDay()->format('Y-m-d H:i:s');
        $dayEndDate = $nowDay->endOfDay()->format('Y-m-d H:i:s');
        return $this->GRep->winning_numbers($game_code, $dayStartDate, $dayEndDate);
    }
}
