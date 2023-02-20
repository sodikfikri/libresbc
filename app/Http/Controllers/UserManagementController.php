<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('user-management.user.index');
    }

    public function role()
    {
        return view('user-management.role.index');
    }
}
