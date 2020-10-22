<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Eticket\Major;
use App\Helpers\Eticket\Wallet;
use App\Mail\DivideReward;
use App\Repositories\Game\GameInterface;
use App\Repositories\Lottery\LotteryInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Vault\VaultInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    protected $ticketRepository;
    protected $gameRepository;
    protected $vaultRepository;
    protected $lotteryRepository;

    public function __construct(TicketInterface $ticketRepository, GameInterface $gameRepository, VaultInterface $vaultRepository, LotteryInterface $lotteryRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->gameRepository = $gameRepository;
        $this->vaultRepository = $vaultRepository;
        $this->lotteryRepository = $lotteryRepository;
        $this->major = new Major();
    }

    public function index(Request $request)
    {

        $data['game'] = $request->has('game_code');
        $data['my_tickets'] = $this->ticketRepository->myTickets($request);
        $data['lotteries'] = $this->lotteryRepository->lotteryHistory();

        if ($request->has('game_code') && $this->gameRepository->getModel()->where('code', $request->game_code)->exists()) {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->where('code', $request->game_code)->first();
        } else {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->first();
        }

        $data['vaults'] = $this->vaultRepository->getVaultsOfGame($data['value']->code);
//        dd($data['value']->toArray());
        return view("client.index", $data);
    }

    public function ticket(Request $request)
    {
        if ($request->has('game_code') && $this->gameRepository->getModel()->where('code', $request->game_code)->exists()) {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->where('code', $request->game_code)->first();
        } else {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->first();
        }
        $data['my_tickets'] = $this->ticketRepository->myTickets($request,true);
        $data['my_tickets_count'] = $this->ticketRepository->myTicketsCount();
        $data['my_winning_tickets'] = $this->ticketRepository->winTickets(true, $request);
        $data['my_winning_tickets_count'] = $this->ticketRepository->winTicketsCount();
//        dd($data['my_tickets_count']);
        return view("client.ticket", $data);
    }

    public function lotteryHistory(Request $request)
    {
        if ($request->has('game_code') && $this->gameRepository->getModel()->where('code', $request->game_code)->exists()) {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->where('code', $request->game_code)->first();
        } else {
            $data['value'] = $this->gameRepository->getModel()->with('sacks')->first();
        }
        $data['lotteries'] = $this->lotteryRepository->lotteryHistory();
        return view("client.lottery", $data);
    }
}
