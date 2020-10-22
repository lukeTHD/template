<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Credit\CreditInterface;
use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ticket;

class StatisticController extends Controller
{
    //

    protected $ticketRepository;
    protected $gameRepository;
    protected $userRepository;
    protected $creditRepository;

    public function __construct(TicketInterface $ticketRepository, GameInterface $gameRepository, UserInterface $userRepository, CreditInterface $creditRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
        $this->creditRepository = $creditRepository;
    }

    public function tickets(Request $request)
    {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfMonth();

        if ($request->has('from')) $from = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
        if ($request->has('to')) $to = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();

        $statistic = $this->ticketRepository->getStatistic($from, $to);

        $convert = $this->convertTickets($statistic);

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success.',
            'data' => $convert
        ]);
    }

    public function credits()
    {
        $statistic = $this->creditRepository->getStatistic();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success.',
            'data' => $statistic
        ]);
    }

    public function games(Request $request)
    {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfDay();

        if ($request->has('from')) $from = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
        if ($request->has('to')) $to = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();

        $statistic = $this->gameRepository->getStatistic($from, $to);

//        $convert = $this->convertGames($statistic);

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success.',
            'data' => $statistic
        ]);
    }

    public function users(Request $request)
    {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfDay();

        if ($request->has('from')) $from = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
        if ($request->has('to')) $to = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();

        $statistic = $this->userRepository->getStatistic();
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success.',
            'data' => $statistic
        ]);
    }

    private function convertTickets($data)
    {
        $output = [];
        foreach ($data as $value) {
            $created_at = $value->created_at;
            $output[$created_at->day]['time'] = "{$created_at->day} / {$created_at->month}";
            if (isset($output[$created_at->day]['quantity'])) $output[$created_at->day]['quantity'] = $output[$created_at->day]['quantity'] + 1;
            else $output[$created_at->day]['quantity'] = 1;
        }

        return collect($output)->values()->toJson();
    }

    private function convertGames($data)
    {
        $output = [];
        $uid = 0;
        if (auth()->check()) $uid = auth()->user()->id;
        $format = setting('time_format', $uid)->value;
        foreach ($data as $value) {
            $created_at = Carbon::createFromFormat($format, $value->created_at);
            $output[$created_at->day]['name'] = $value->name;
            $output[$created_at->day]['quantity'] = $value->tickets()->count();
//            if (isset($output[$created_at->day]['quantity'])) $output[$created_at->day]['quantity'] = $output[$created_at->day]['quantity'] + 1;
//            else $output[$created_at->day]['quantity'] = 1;
        }

        return collect($output)->values()->toJson();
    }

    public function topWinners()
    {
        $data = [];

        return response()->json([
            'jackpot' => [
                [
                    'user_id' => '402461137',
                    'name' => 'Johnny Dang',
                    'money' => 912321232
                ],
                [
                    'user_id' => '53797425',
                    'name' => 'Robert Downey Jr.',
                    'money' => 812322341
                ], [
                    'user_id' => '879543678',
                    'name' => 'Jennie Phuong',
                    'money' => 654535214
                ], [
                    'user_id' => '335311255',
                    'name' => 'Chris Anh',
                    'money' => 521535214
                ],
            ],
            'first_prize' => [
                [
                    'user_id' => '402461137',
                    'name' => 'Johnny Dang',
                    'money' => 912321232
                ],
                [
                    'user_id' => '53797425',
                    'name' => 'Robert Downey Jr.',
                    'money' => 812322341
                ], [
                    'user_id' => '879543678',
                    'name' => 'Jennie Phuong',
                    'money' => 654535214
                ], [
                    'user_id' => '335311255',
                    'name' => 'Chris Anh',
                    'money' => 521535214
                ],
            ],
            'second_prize' => [
                [
                    'user_id' => '402461137',
                    'name' => 'Johnny Dang',
                    'money' => 912321232
                ],
                [
                    'user_id' => '53797425',
                    'name' => 'Robert Downey Jr.',
                    'money' => 812322341
                ], [
                    'user_id' => '879543678',
                    'name' => 'Jennie Phuong',
                    'money' => 654535214
                ], [
                    'user_id' => '335311255',
                    'name' => 'Chris Anh',
                    'money' => 521535214
                ],
            ]
        ]);
    }
}
