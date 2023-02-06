<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function table_list() 
    {
        return view('routing.table.index');
    }

    public function record() 
    {
        return view('routing.record.index');
    }
}
