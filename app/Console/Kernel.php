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
        $schedule->command('backup:clean')->weeklyOn(7, '22:00');//Отчистка бэкопов
        $schedule->command('db:backup')->weeklyOn(7, '23:00'); // Создание бэкапа базы
        $schedule->command('excel:update')->weeklyOn(4, '23:00');// Обновление excel таблиц
        $schedule->command('backup:run --only-files')->weeklyOn(7, '23:30');// Бэкап файлов
        $schedule->command('word:search_phrase')->dailyAt('5:30');// Поиск новых слов в фразах
        $schedule->command('word:search_sentence')->dailyAt('6:30');// Поиск новых слов в предложениях
        $schedule->command('phrase:sync')->dailyAt('07:00');// Обновление фраз
        $schedule->command('listen:sync')->dailyAt('07:30');// Обновление предложений
        $schedule->command('youtube:sync')->dailyAt('08:00');// Создание карточек к видео
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
