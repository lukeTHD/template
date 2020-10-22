<?php

namespace App\Repositories\Ticket;

use Illuminate\Database\Eloquent\Model;

interface TicketInterface
{
    public function __construct(Model $model, Model $bookingModel, Model $userModel, Model $vaultModel, Model $gameModel);

    public function postBooking($data, $game, $uid, $currency);

    public function addTicket($data, $game, $user, $picked_at);

    public function getStatistic($from, $to);

    public function myTickets($request, $is_all);

    public function winTickets($is_paginate, $request);

    public function ticketNotAddToVault();

    public function seen($id);

    public function ticketsCongratulation($uid);

    public function countWinningTickets();

    public function countJackpotWinners();

    public function totalAmountAwarded();
}
