<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClusterController extends Controller
{
    public function index() 
    {
        return view('cluster.index');
    }
}
