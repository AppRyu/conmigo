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

    public function show(String $user_name)
    {
        $user = User::where('user_name', $user_name)->first();
        return view('users.show', ['user' => $user]);
    }

    public function edit(String $user_name)
    {
        $user = User::where('user_name', $user_name)->first();
        return view('users.edit', ['user' => $user]);
    }
}
