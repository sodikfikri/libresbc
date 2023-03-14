<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ScheduleIns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InsData:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert data use schedule laravel';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
        
        DB::table('testroutev2')->insert([
            'destination_number' => '+123',
            'primary_route' => 'TEST_AJA',
            'secondary_route' => 'TEST_AJA',
            'cretaed_at' => Carbon::now('Asia/Jakarta')->timestamp
        ]);
    }
}
