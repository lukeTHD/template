<?php

namespace App\Console;

use App\Console\Commands\DemoCron;
use App\Repositories\Game\GameInterface;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Psy\Command\Command;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\JackpotCron::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('jackpot:run1')
            ->everyMinute();
//            ->dailyAt("23:55");
        // $schedule->command('inspire')
        //          ->hourly();
//        foreach(app(GameInterface::class)->all() as $game) {
//            $schedule->command('lottery:run --id=' . $game->id);
//            $schedule->command('lottery:run',['game' => $game])->dailyAt($game->roll_time);
//        }/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
