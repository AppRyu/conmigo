<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

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
        
        if($request->hasFile('profile_image')) {
            // 過去の画像を削除
            Storage::delete('public/img/'.$user->profile_image);

            $file = $request->file('profile_image');
            // 拡張子を含むファイル名を取得
            $filenameWithExt = $file->getClientOriginalName();

            // 拡張子を含まないファイル名を取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);

            // ファイルの拡張子を取得
            $extension = $file->getClientOriginalExtension();

            // 保存する画像名
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // 保存先までのパス
            $storage_path = public_path('storage/img/'.$fileNameToStore);

            // 画像を保存
            InterventionImage::make($file)->fit(200, 200)->save($storage_path);
            
            // データベースに画像名を追加
            $user->profile_image = $fileNameToStore;
        } 

        $user->fill($request->except('profile_image'))->save();

        return redirect()->route('user.show', ['user_name' => $user->user_name]);
    }

    public function edit(String $user_name)
    {
        $user = User::where('user_name', $user_name)->first();
        return view('users.edit', ['user' => $user]);
    }

}
