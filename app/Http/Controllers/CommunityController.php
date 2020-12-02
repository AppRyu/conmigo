<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        return view('community.index');
    }

    public function show()
    {
        return view('community.show');
    }

    public function create()
    {
        return view('community.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        dd($input);
    }
}
