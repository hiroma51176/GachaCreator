<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrizeController extends Controller
{
    public function index()
    {
        return view('user.gacha.prize.list');
    }
    
    public function add()
    {
        return view('user.gacha.prize.create');
    }
    
    public function create(Request $request)
    {
        // バリデーションをかける
        //$this->validate($request, Prize::$rules);
        
        //$prize = new Prize;
        //$form = $request->all();
        
        //if($form['image']){
            //$path = $request->file('image')->store('public/image');
            //$prize->image_path = basename($path);
        //}else{
            //$prize->image_path = null;
        //}
        
        //unset($form['_token']);
        //unset($form['image']);
        
        //$prize->fill($form)->save();
        
        // 追加してリストに戻る場合
        if(isset($request->to_list)){
            return view('user.gacha.prize.list');
        }
            
        // 続けて追加する場合
        elseif(isset($request->cont)){
            return view('user.gacha.prize.create');
        }
        return view('user.gacha.prize.list');
    }
    
    public function edit()
    {
        return view('user.gacha.prize.edit');
    }
    
    public function update()
    {
        return view('user.gacha.prize.list');
    }
    
    public function delete()
    {
        return view('user.gacha.prize.list');
    }
}
