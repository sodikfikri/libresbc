<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Exception;
use Illuminate\Support\Carbon;

class Helper 
{
    public function GetApi($data = [])
    {
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, env('SBC_API').$data['url']);
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // $output contains the output string 
        $res = curl_exec($ch); 
        // tutup curl 
        curl_close($ch);

        return json_decode($res);
    }
}