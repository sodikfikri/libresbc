<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SipprofileController extends Controller
{
    public function index() 
    {
        return view('sipprofile.index');
    }

    public function detail() 
    {
        return view('sipprofile.detail');
    }
}
