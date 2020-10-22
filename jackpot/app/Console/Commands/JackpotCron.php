<?php

namespace App\Console\Commands;

use App\Game;
use App\Repositories\Game\GameInterface;
use Illuminate\Console\Command;
use App\Jackpot;
use Illuminate\Support\Facades\Log;

class JackpotCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jackpot:run1';

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
//        $game_code = api("run");
//        $this->info('jackpot:run Command Run successfully!' . json_encode($game_code));
        Log::info("cronjob run jackpot:run1");
//        $games = app(GameInterface::class)->getModel()->with('game_rewards')->get();
//
//        foreach ($games as $game) {
//            dump((new Jackpot\Random)->run($game));
//        }
    }
}
