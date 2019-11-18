<?php

namespace App\Console;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // Backups (to Google Drive)
        $schedule->command('backup:clean')->weeklyOn(7, '22:00');
        $schedule->command('db:backup')->weeklyOn(7, '23:00');
        $schedule->command('backup:run --only-files')->weeklyOn(7, '23:30');
        $schedule->command('word:search_phrase')->dailyAt('5:30');
        $schedule->command('word:search_sentence')->dailyAt('7:30');
        $schedule->command('phrase:sync')->dailyAt('08:00');
        $schedule->command('listen:sync')->dailyAt('08:30');
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
