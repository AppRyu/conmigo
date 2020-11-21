<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
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

    public function update(UserRequest $request, String $user_name)
    {
        $user = User::where('user_name', $user_name)->first();
        $user->fill($request->all())->save();
        return redirect()->route('user.show', ['user_name' => $user->user_name]);
    }

    public function edit(String $user_name)
    {
        $user = User::where('user_name', $user_name)->first();
        return view('users.edit', ['user' => $user]);
    }
}
