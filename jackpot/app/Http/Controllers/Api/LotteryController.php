<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Game\RewardGame;
use App\Helpers\Lottery\Get;
use App\Helpers\Lottery\Run;
use App\Lottery;
use App\Mail\DivideReward;
use App\Repositories\Game\GameInterface;
use App\Repositories\Lottery\LotteryInterface;
use App\Repositories\Ticket\TicketInterface;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LotteryController extends Controller
{

    use PaginationTrait;

    protected $lottery;
    protected $lotteryRepository;
    protected $ticketRepository;
    protected $gameRepository;

    public function __construct(Lottery $lottery, LotteryInterface $lotteryRepository, TicketInterface $ticketRepository, GameInterface $gameRepository)
    {
        can($this, 'lottery', ['index', 'edit']);
        $this->lottery = $lottery;
        $this->lotteryRepository = $lotteryRepository;
        $this->ticketRepository = $ticketRepository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('is_pagination') && $request->is_pagination) {
            $this->order_field = 'id';
            $this->params = $request->all();
            $this->query = $this->lottery->query();
            $this->field_search = ['numbers'];

            $this->setStatus('status', false);
            $this->setStatus('search', true);

            $results = $this->getResults();

            return response()->json([
                'meta' => $results[0],
                'data' => $results[1]
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->lottery->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->lottery->with(['tickets' => function ($query) {
                $query->with('user');
            }])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function run()
    {
        DB::beginTransaction();
        try {
            $game_code = "5x36";
            $game = app(GameInterface::class)->getModel()->where('code', $game_code)->first();
            if (!$this->lotteryRepository->getModel()->where('game_code', $game_code)->where('created_at', '>=', now('UTC')->startOfDay())->where('created_at', '<=', now('UTC')->endOfDay())->exists() || env('APP_ENV') === 'local') {
                if (now('UTC')->between(Carbon::createFromFormat('H:i:s', $game->roll_time), Carbon::createFromFormat('H:i:s', $game->start_time)->addDay()) || env('APP_ENV') === 'local') {
                    $run = new Run();
                    $run->init($game);
                    echo "Quay số :";
                    DB::commit();
                    echo "<pre>";
                    print_r($run->run());
                    echo "</pre>";
                } else {
                    echo 'no !';
                }
            } else {
                echo "ngay hom nay quay so roi";
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new $exception;
        }
    }

    public function get(RewardGame $rewardGame)
    {
        DB::beginTransaction();
        try {
//            if (!request()->has('id')) dd('id is required');
//            if (!exists(request()->get('id'), 'lotteries')) dd('not exists');
//            if ($this->lotteryRepository->getModel()->where('id', request()->get('id'))->first()->is_done != 0) {
//                dd('lottery can\'t get anymore ');
//            }

            // Get last lottery of game ...
            $lottery = $this->lotteryRepository->getModel()->orderBy('id', 'DESC')->first();
            if (!$lottery) {
                return response()->json(['status' => false, "msg" => "so khong ton tai!"]);
            }
            if ($lottery->is_done == 1) {
                return response()->json(['status' => false, "msg" => "so da dc chia thuong!"]);
            }

            // Get all tickets and rewards of game ...
            $game = app(GameInterface::class)->getModel()->where('code', $lottery->game_code)->with(['tickets' => function ($query) {
                $query->where('status', 'create')->where('picked_at', '>=', now('UTC')->startOfDay())->where('picked_at', '<=', now('UTC')->endOfDay());
            }, 'games_config'])->first();
//            dd($game);
            $get = new Get();
            $get->init($game);
            Log::channel('lottery')->notice('lottery:get:notice', $lottery->toArray());
            $tickets = $get->getAllTickets($lottery->numbers);
//            dd($tickets);
            $winTickets = $tickets[0];

            Log::channel('reward')->notice('reward:win_tickets:notice', $winTickets ? $winTickets : []);

            $loseTickets = $tickets[1];

            // Handle win tickets
            if ($winTickets) {

                foreach ($winTickets as $reward => $winTicket) {

                    $rewardGame->init($lottery->game_code, $reward, $winTicket['users'], $winTicket['tickets'], $winTicket['prize_id'], $lottery->id);
//                dump("status: " . $rewardGame->run());
                    if ($resultLottery = $rewardGame->run() == true || env('APP_ENV') === 'local') {
                        dump($resultLottery);
                        $this->ticketRepository->getModel()->whereIn('id', $winTicket['ticket_ids'])->update([
                            'prize_id' => $winTicket['prize_id'],
                            'prize_value' => $rewardGame->getMoneyWinner(),
                            'status' => 'success',
                            'is_divide_money' => 1,
                            'lottery_id' => $lottery->id,
                            'is_seen_congratulation' => 0
                        ]);

                        // Commissions
                        // send mail trung thuong

                        $ticketSendMail = $this->ticketRepository->getModel()->whereIn('id', $winTicket['ticket_ids'])->with(['game:id,name', 'user'])->get();

                        foreach ($ticketSendMail as $ticket) {
                            $data = [
                                "TICKET_ID" => $ticket->id,
                                "AMOUNT" => $ticket->prize_value,
                                "GAME_NAME" => $ticket->game->name,
                                "PRICE" => $ticket->price,
                                "QUALITY" => 1,
                                "TICKET" => implode(", ", $ticket->picked),
                                "LINK" => route("client.dashboard.ticket"),
                                "CUSTOMERNAME" => $ticket->user->email,
                                "EMAIL" => $ticket->user->email,
                                "PHONE" => json_decode($ticket->user->user_info, true)['phone_number']
                            ];
//                            Mail::to($ticket->user->email)->send(new DivideReward($data));
                        }
                    }
                }
            }

            // Handle lose tickets
            if ($loseTickets) {
                $this->ticketRepository->getModel()->whereIn('id', $loseTickets)->update([
                    'status' => 'failed',
                    'lottery_id' => $lottery->id
                ]);
            }

//            dump("=== Vé trúng ===");
//            if ($winTickets) {
//                foreach ($winTickets as $same => $winTicket) {
//                    dump("Trúng " . $same . " số");
//                    foreach ($winTicket['tickets'] as $ticket) {
//                        dump(json_encode($this->ticketRepository->find($ticket)->picked));
//                    }
//                }
//            } else {
//                dump("Không có vé trúng !");
//            }
//            dump("==========================================");
//            dump("=== Vé không trúng ===");
////        i
//            $loseTickets = collect($loseTickets)->map(function ($value) {
//                $data = $this->ticketRepository->find($value);
//                return json_encode($data->picked);
//            })->toArray();
//            if ($loseTickets) {
//                dump($loseTickets);
//            } else {
//                dump("Không có vé không trúng !");
//            }

            $this->lotteryRepository->getModel()->where('id', $lottery->id)->update([
                'is_done' => 1
            ]);
            DB::commit();
            return response()->json(['status' => true, "msg" => "divide reward success"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false, "msg" => $exception->getMessage()]);
        }
    }

    public function updateVaults()
    {
        DB::beginTransaction();
        try {
            $games = $this->gameRepository->getModel()->with(['tickets' => function ($query) {
                $query->where('is_add_vault', config('constants.vault.not_add_to_vault'))->where('picked_at', '>=', now('UTC')->startOfDay())->where('picked_at', '<=', now('UTC')->endOfDay());
            }])->get();
            foreach ($games as $game) {
                $game['tickets']->groupBy('booking_id')->map(function ($value, $key) use ($game) {
                    $total_price = $value->sum('price');
                    $ids = $value->map(function ($query) {
                        return $query->only('id');
                    })->flatten();
                    $this->ticketRepository->addVaultForGame($total_price, $game, $key);
                    $this->ticketRepository->getModel()->whereIn('id', $ids)->update([
                        'is_add_vault' => config('constants.vault.add_to_vault')
                    ]);
                });
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('crate')->error('vault:update_crate:error:code', $exception->getMessage());
            Log::channel('crate')->debug('crate:update_crate:debug:code', $exception);
            dd($exception->getMessage());
        }
    }

    public function list()
    {
        return response()->json($this->lotteryRepository->getModel()->orderBy('id', 'DESC')->get()->map(function ($value) {
            $return['total_amount_jackpot'] = numberFormat($value['total_jackpot']);
            $return['numbers'] = implode(",", $value['numbers']);
            $return['lottery_at'] = $value['created_at']->toDateTimeString();
            return $return;
        }));
    }

    public function api($id)
    {
        return response()->json($this->lotteryRepository->getModel()->where('id', $id)->orderBy('id', 'DESC')->get()->map(function ($value) {
            $return['total_amount_jackpot'] = numberFormat($value['total_jackpot']);
            $return['numbers'] = implode(",", $value['numbers']);
            $return['lottery_at'] = $value['created_at']->toDateTimeString();
            return $return;
        })->first());
    }
}
