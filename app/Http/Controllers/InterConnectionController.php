<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterConnectionController extends Controller
{
    public function inbound() 
    {
        return view('inter-connection.in-bound.index');
    }

    public function outbound()
    {
        return view('inter-connection.out-bound.index');
    }
}
