<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\FAQ\FAQInterface;
use App\Repositories\MetaBox\MetaBoxInterface;
use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\User\UserInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    private $GRep;
    private $FAQRep;
    protected $ticketRepository;

    public function __construct(GameInterface $repository, FAQInterface $FAQRep,TicketInterface $ticketRepository)
    {
        $this->GRep = $repository;
        $this->FAQRep = $FAQRep;
        $this->ticketRepository = $ticketRepository;
    }

    public function index()
    {

//        Artisan::call('optimize');
//        Artisan::call('migrate',
//            [
//                '--seed' => true
//            ]);
//        Artisan::call('optimize');
        $nowDay = Carbon::now('UTC');
//        $mytime = Carbon::now();
//        echo $mytime->toDateTimeString();die;
        $mListGame = $this->GRep->allGame();
//        dd($mListGame);
        foreach ($mListGame as $key => $value) {
            $mListGame[$key]->start_time = $nowDay->toDateString() . " " . $value->start_time;
            $mListGame[$key]->end_time = $nowDay->toDateString() . " " . $value->end_time;
        }
//        dd($mListGame);
        return view("client.home.index", [
            "mListGame" => $mListGame
        ]);
    }

    public function token()
    {
        return view("client.home.token");
    }

    public function affiliate()
    {
        return view("client.home.affiliate");
    }

    public function howToPlay()
    {
        $mList = $this->FAQRep->all();
//        dd($mList);
        return view("client.home.howToPlay", [
            "mList" => $mList
        ]);
    }

    public function top()
    {
        $data['top_winners'] = app(UserInterface::class)->topWinners();
        $data['count_winning_tickets'] = $this->ticketRepository->countWinningTickets();
        $data['count_jackpot_winners'] = $this->ticketRepository->countJackpotWinners();
        $data['total_amount_awarded'] = $this->ticketRepository->totalAmountAwarded();
        return view("client.home.top", $data);
    }

    public function Subscribe(Request $request)
    {
        $param = $request->all();
        return view("client.mail.subscribe", ["email" => $param['email']]);
    }

    public function roadmap()
    {
        return view("client.home.roadmap");
    }

    public function term()
    {
        return view("client.home.term");
    }

    public function regulation()
    {
        return view("client.home.regulation");
    }
}
