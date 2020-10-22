<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Game\GameInterface;
use App\Mail\DivideReward;
use Mail;
class MailController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
//        $game_code =
        $data = [
            "TICKET_ID"=>"1",
            "AMOUNT"=>70,
            "GAME_NAME"=>"5x36",
            "PRICE"=>1,
            "QUALITY"=>1,
            "TICKET"=>1,
            "LINK"=>route("client.dashboard.ticket"),
            "CUSTOMERNAME"=>"NGUYEN THANH HAI",
            "EMAIL"=>"tkasjdklj@gmail.com",
            "PHONE"=>"032365656"
        ];
        Mail::to("thanhaideveloper@gmail.com")->send(new DivideReward($data));
        return view('client.mail.divide-reward',$data);
    }

}
