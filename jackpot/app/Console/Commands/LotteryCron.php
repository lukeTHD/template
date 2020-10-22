<?php

namespace App\Console\Commands;

use App\Game;
use App\Helpers\Lottery\LotteryBase;
use App\Helpers\Lottery\Run;
use App\Repositories\Game\GameInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class LotteryCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lottery time';

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
//        $id = 1;
//        $game = app(GameInterface::class)->getModel()->where('id', $id)->with(['tickets' => function ($query) {
//            $query->where('status','create')->where('picked_at', '>=', now('UTC')->startOfDay())->where('picked_at', '<=', now('UTC')->endOfDay());
//        },'games_config'])->first();
//        $run = new Run();
//        $run->init($game);
//        dd($run->run());
    }
}
