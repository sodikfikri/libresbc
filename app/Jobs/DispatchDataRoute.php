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

class DispatchDataRoute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    public $response;
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
        $arr_push = [];

        foreach($this->data as $key => $val) {
            $ck = DB::table('testroutev2')->where('destination_number', $val['destination_number'])->get();
            if (count($ck) == 0) {
                array_push($arr_push, $val);
            } else {
                $val['reason'] = 'data laready exists';
                $val['created_at'] = Carbon::now()->timestamp;
                DB::table('failed_insert')->insert($val);
            }
        }

        DB::table('testroutev2')->insert($arr_push);
    }
}
