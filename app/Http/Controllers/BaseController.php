<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function natalias_list() 
    {
        return view('base.natalias.index');
    }

    public function firewall_list() 
    {
        return view('base.firewall.index');
    }

    public function gateway_list() 
    {
        return view('base.gateway.index');
    }

    public function acl_list() 
    {
        return view('base.acl.index');
    }
}
