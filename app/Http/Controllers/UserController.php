<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show()
    {
        return view('users.show');
    }

    public function edit()
    {
        return view('users.edit');
    }
}
