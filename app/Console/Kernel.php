<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\Actor::class,
        \App\Console\Commands\AutoStatistik::class,
        \App\Console\Commands\Country::class,
        \App\Console\Commands\Flagofship::class,
        \App\Console\Commands\Incident::class,
        \App\Console\Commands\Nighttype::class,
        \App\Console\Commands\Perpetrators::class,
        \App\Console\Commands\Stolenproperty::class,
        \App\Console\Commands\Tanggal::class,
        \App\Console\Commands\Timeofincident::class,
        \App\Console\Commands\Treatmentofcrew::class,
        \App\Console\Commands\Typeofship::class,
        \App\Console\Commands\Weapon::class,
        \App\Console\Commands\Assaulted::class,
        \App\Console\Commands\Timetype::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('task:runcategory')->everyTenMinutes();;

        $schedule->command('task:runactor')->everyFifteenMinutes();

        $schedule->command('task:runcountry')->everyFifteenMinutes();

        $schedule->command('task:runflagofship')->everyFifteenMinutes();

        $schedule->command('task:runincident')->everyFifteenMinutes();

        $schedule->command('task:runnighttype')->everyFifteenMinutes();

        $schedule->command('task:runperpetrators')->everyFifteenMinutes();

        $schedule->command('task:runstolenproperty')->everyFifteenMinutes();

        $schedule->command('task:runtanggal')->everyFifteenMinutes();

        $schedule->command('task:runtimeofincident')->everyFifteenMinutes();

        $schedule->command('task:runtreatmentofcrew')->everyFifteenMinutes();

        $schedule->command('task:runtypeofship')->everyFifteenMinutes();

        $schedule->command('task:runweapon')->everyFifteenMinutes();

        $schedule->command('task:runassaulted')->everyFifteenMinutes();

        $schedule->command('task:runtimetype')->everyFifteenMinutes();

        $schedule->command('task:runcommand')->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
