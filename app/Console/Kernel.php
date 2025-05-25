<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log; // ✅ Tambahkan ini

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Debug - cek apakah method ini dipanggil
        Log::info('Schedule method called');
        
        $schedule->command('pengingat:kirim')->dailyAt('08:15');
        
        Log::info('Command scheduled');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
