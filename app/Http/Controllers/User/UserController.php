<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        // ゲスト用アカウントの場合は、トップページへリダイレクト
        if(Auth::user()->email == 'hoge@example.com'){
            return redirect('/');
        }
        
        return view('auth.profile');
    }
    
    public function update(Request $request)
    {
        // バリデーションをかける
        // $this->validate($request, User::$rules);
        
        $myEmail = Auth::user()->email;
        
        // バリデーションを設定
        $this->validate($request, [
            'name' => 'required | string | max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->whereNot('email', $myEmail)],
            'current_password' => 'required',
            'new_password' => 'required | string | min:8 | confirmed',
        ]);
        
        
        
        // 現在のパスワードが正しいか調べる
        if(!(Hash::check($request->current_password, Auth::user()->password))){
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています');
        }
        
        // 現在のパスワードと新しいパスワードが違うものか調べる
        if(strcmp($request->current_password, $request->new_password) == 0){
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを入力してください');
        }
        
        $user_data = Auth::user();
        
        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->password = bcrypt($request->new_password);
        $user_data->save();
        
        return redirect('/')->with('user_data', 'ユーザー情報を編集しました');
    }
}
