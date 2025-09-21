<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

use App\Console\Commands\SendPaymentReminders;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendPaymentReminders::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('reminders:send')
                 ->dailyAt('08:00')
                 ->onFailure(function () {
                     Log::error('Pengiriman email reminder gagal.');
                 });
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
