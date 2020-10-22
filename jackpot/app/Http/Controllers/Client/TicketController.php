<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Ticket\TicketInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    protected $ticketRepository;

    public function __construct(TicketInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function ticketSeenCongratulation(Request $request)
    {
        $request->validate([
            'id' => 'exists:tickets'
        ]);

        return response()->json($this->ticketRepository->seen($request->id));
    }
}
