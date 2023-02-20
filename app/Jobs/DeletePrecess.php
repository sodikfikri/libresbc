<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DeletePrecess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->data as $key => $val) {
            $cek = DB::table('testroutev2')->where('destination_number', $val['destination_number'])->get();
            if (count($cek) != 0) {
                $params = [
                    'destination_number' => $val['destination_number'],
                    'code' => 0,
                    'response' => 'SUCCESS',
                    'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
                ];
                DB::table('testroutev2')->where('destination_number', $val['destination_number'])->delete();
                DB::table('msidn_delete_log')->insert($params);
            } else {
                $params = [
                    'destination_number' => $val['destination_number'],
                    'code' => 10007,
                    'response' => 'MSISDN/IMSI VALUE NOT FOUND IN HSS',
                    'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
                ];
                DB::table('msidn_delete_log')->insert($params);
            }
        }
    }
}
