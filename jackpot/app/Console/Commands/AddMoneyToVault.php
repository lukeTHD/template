<?php

namespace App\Console\Commands;

use App\Repositories\Ticket\TicketInterface;
use Illuminate\Console\Command;

class AddMoneyToVault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vault:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        dd(app(TicketInterface::class)->ticketNotAddToVault());
    }
}
