<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule): void
    {
        // 🕒 Daily 1 time expired products move হবে
        $schedule->command('products:move-expired')->daily();

        // $schedule->command('products:move-expired')->dailyAt('00:00');
    }


     protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
