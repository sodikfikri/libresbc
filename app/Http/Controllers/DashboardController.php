<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard(Request $request) 
    {
        // dd($request->token);
        return view('dsb.index');
    }
}
