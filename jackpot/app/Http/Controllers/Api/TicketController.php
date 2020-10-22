<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Requests\StoreTicket;
use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\Ticket\TicketRepository;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaginationTrait;

class TicketController extends Controller
{

    use PaginationTrait;

    protected $ticket;
    protected $gameRepository;
    protected $ticketRepository;

    public function __construct(Ticket $ticket,GameInterface $gameRepository,TicketInterface $ticketRepository)
    {
        can($this,'ticket',['index','create','store']);
        $this->middleware('auth:api');
        $this->ticket = $ticket;
        $this->gameRepository = $gameRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('is_pagination') && $request->is_pagination) {
            $this->params = $request->all();
            $this->query = $this->ticket->query();
            $this->field_search = ['picked'];
            $this->order_field = 'created_at';
            $this->with = ['game', 'user'];

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
            'data' => $this->ticket->get()
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTicket $request)
    {
        $game = $this->gameRepository->findOrFail($request->game_id);
        $instance = $this->checkTickets($request->tickets, $game);
//        return response()->json([
//            'data' => $instance
//        ]);
        if ($instance['status'] !== false) {
            return response()->json([
                'status' => true,
                'code' => 0,
                'message' => 'success.',
                'data' => $this->ticketRepository->postBooking($instance, $game)
            ]);
        }

        if ($instance['code'] === 2) {
            return response()->json([
                'status' => false,
                'code' => code('NOT_ENOUGH_MONEY'),
                'message' => 'failed.',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => code('INPUT_TICKET_WRONG'),
            'message' => 'failed.',
            'data' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => $this->ticketRepository->getModel()->with(['user', 'game','prize','lottery'])->findOrFail($id)
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

    public function checkTickets($tickets, $game)
    {
        $flag = true;
        $total_price = 0;
        $total_quantity = 0;
        $code = 1;
        $tickets = collect($tickets)->map(function ($value) use (&$flag, $game, &$total_price, &$total_quantity) {
            if (count($value) !== (int)$game->number_pick) {
                $flag = false;
            }

            $loaded = [];
            $data['picked'] = collect($value)->map(function ($value) use (&$flag, $game, &$loaded) {
                $value = (int)$value;
                if ($value > $game->number_max || isset($loaded[$value])) {
                    $flag = false;
                }
                $loaded[$value] = $value;
                if ($value > 0 && $value < 10) $value = '0' . $value;
                return (string)$value;
            })->toArray();
            $data['uid'] = auth()->user()->id;
            $data['type'] = 'standard';
            $data['game_id'] = $game->id;
            $data['price'] = $game->price;
            $data['created_at'] = now();
            $data['status'] = 'create';
            $total_price += $game->price;
            $total_quantity++;
            return $data;
        })->toArray();

        if (auth()->user()->credit->value <= $total_price) {
            $flag = false;
            $code = 2;
        }

        return [
            'status' => $flag,
            'tickets' => $tickets,
            'total_price' => $total_price,
            'total_quantity' => $total_quantity,
            'code' => $code
        ];
    }
}
