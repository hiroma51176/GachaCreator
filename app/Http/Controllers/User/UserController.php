<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function edit()
    {
        return view('auth.profile');
    }
    
    public function update(Request $request)
    {
        // バリデーションをかける
        $this->validate($request, User::$rules);
        
        // 現在のパスワードが正しいか調べる
        if(!(Hash::check($request->current_password, Auth::user()->password))){
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています');
        }
        
        // 現在のパスワードと新しいパスワードが違うものか調べる
        if(strcmp($request->current_password, $request->new_password)){
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを入力してください');
        }
        
        $user_data = Auth::user();
        
        $user_data = $request->name;
        $user_data = $request->email;
        $user_data->password = bcrypt($request->new_password);
        $user_data->save();
        
        return redirect('/')->with('user_data', 'ユーザー情報を編集しました');
    }
}
