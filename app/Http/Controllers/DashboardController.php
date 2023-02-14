<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function Dashboard(Request $request) 
    {
        // dd($request->jwt);
        return view('dsb.index');
    }
}
