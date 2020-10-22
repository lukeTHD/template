<?php


namespace App\Helpers\Game;

use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;

class DialGame
{

    private $gameRep;

    public function __construct(GameInterface $gameRep, TicketInterface $ticketRep)
    {
        $this->gameRep = $gameRep;
        $this->ticketRep = $ticketRep;
    }



}
