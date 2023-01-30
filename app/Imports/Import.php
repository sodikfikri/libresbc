<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Jobs\DispatchDataRoute;
use Illuminate\Support\Facades\DB;

class Import implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $data = [];
        foreach($rows as $key => $val) {
            $obj = [
                'destination_number' => $val[0],
                'primary_route' => $val[1],
                'secondary_route' => $val[2],
            ];
            if ($key != 0) {
                $ck = DB::table('getroutev2')->where('destination_number', $val[0])->get();

                if (count($ck) == 0) {
                    array_push($data, $obj);
                }
            }
        }
        // dd(array_chunk($data, 8000));
        $chunk = array_chunk($data, 8000);
        // dd($chunk);
        foreach($chunk as $key => $val) {
            // dd($val);
            DispatchDataRoute::dispatch($val);
        }
    }
}
