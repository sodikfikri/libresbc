<?php

namespace App\Console;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    // protected $commands = [
    //     Commands\ScheduleIns::class,
    // ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->commands('InsData:cron')->cron('*/5 * * * *');
        $schedule->call(function() {
            $rand = rand(2,500);
            
            DB::table('testroutev2')->insert([
                'destination_number' => $rand,
                'primary_route' => 'TEST_AJA',
                'secondary_route' => 'TEST_AJA',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i')
            ]);
        })->cron('*/2 * * * *');
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
