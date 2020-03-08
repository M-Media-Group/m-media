<?php

namespace App\Console;

use App\Jobs\LinkEmailsToPrimaryOwners;
use App\Jobs\ScrapeInstagramAccounts;
use App\Jobs\SyncBots;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //     ->everyMinute();
        $schedule->command('telescope:prune')->daily();
        $schedule->job(new SyncBots())->hourly()->between('7:00', '23:00');
        $schedule->job(new ScrapeInstagramAccounts())->dailyAt('23:00');
        $schedule->job(new LinkEmailsToPrimaryOwners())->dailyAt('23:59');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
