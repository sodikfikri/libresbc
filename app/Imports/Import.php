<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Jobs\DispatchDataRoute;
use App\Jobs\ChekRouteData;
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
                'destination_number' => '+'.$val[0],
                'primary_route' => $val[1],
                'secondary_route' => $val[2],
            ];
            if ($key != 0) {
                array_push($data, $obj);
            }
        }
        // bagi per 5000 data
        $chunk = array_chunk($data, 5000);
        // dd($chunk[0]);
        // dd($chunk);
        foreach($chunk as $key => $val) {
            DispatchDataRoute::dispatch($val);
        }
    }
}
