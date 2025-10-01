<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Kernel Console da aplicação
 * 
 * Este arquivo define os comandos Artisan e agendamentos (schedules)
 * da aplicação Laravel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * Define o agendamento de comandos da aplicação
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Registra os comandos para a aplicação
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

