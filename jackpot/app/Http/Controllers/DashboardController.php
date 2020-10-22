<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Mail\DivideReward;
use App\Repositories\Credit\CreditInterface;
use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Vault\VaultInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    protected $ticketRepository;
    protected $gameRepository;
    protected $creditRepository;
    protected $vaultRepository;
    protected $userRepository;

    public function __construct(TicketInterface $ticketRepository, GameInterface $gameRepository, CreditInterface $creditRepository, VaultInterface $vaultRepository, UserInterface $userRepository)
    {
        can($this, 'dashboard', ['index']);
        $this->ticketRepository = $ticketRepository;
        $this->gameRepository = $gameRepository;
        $this->creditRepository = $creditRepository;
        $this->vaultRepository = $vaultRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $vaults = $this->vaultRepository->getVaultsOfGame();
        return view('admin.dashboard.index', ['games' => $vaults]);
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
