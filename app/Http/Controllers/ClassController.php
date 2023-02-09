<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function capacity()
    {
        return view('class.capacity.index');
    }

    public function manipulation() 
    {
        return view('class.manipulation.index');
    }

    public function manipulation_detail() 
    {
        return view('class.manipulation.detail');
    }

    public function media() 
    {
        return view('class.media.index');
    } 

    public function preanswer()
    {
        return view('class.preanswer.index');
    }

    public function translation()
    {
        return view('class.translation.index');
    }
}
