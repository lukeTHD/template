<?php

namespace App\Http\Controllers;

use App\Repositories\Game\GameInterface;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\Ticket\TicketRepository;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{

    protected $ticket;

    protected $gameRepository;

    protected $ticketRepository;

    public function __construct(Ticket $ticket,GameInterface $gameRepository,TicketInterface $ticketRepository)
    {
        can($this,'ticket',['index','create','store']);
        $this->ticket = $ticket;
        $this->gameRepository = $gameRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        return view('admin.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $requestInput = $request->except('_token');
        if(isset($requestInput['picked'])) $requestInput['picked'] = json_decode($requestInput['picked'],true);

        $response = api('api.tickets.store', 'POST', $requestInput, false);
        if (!$response['status']) {
            if ($response['code'] === code(ValidationException::class)) {
                return back()->withErrors($response['data'])->withInput($request->input());
            }
        } else {
            flash_message('success', __('label.ticket.add_success'));
            return redirect()->route('admin.tickets.create');
//            return redirect()->route('admin.tickets.edit', ['ticket' => $response['data']['id']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //
        return view('admin.tickets.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
