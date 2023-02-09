<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterConnectionController extends Controller
{
    public function inbound() 
    {
        return view('inter-connection.in-bound.index');
    }

    public function inbound_detail() 
    {
        return view('inter-connection.in-bound.detail');
    }

    public function outbound()
    {
        return view('inter-connection.out-bound.index');
    }

    public function outbound_detail()
    {
        return view('inter-connection.out-bound.detail');
    }
}
