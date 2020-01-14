<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GachaController extends Controller
{
    public function index()
    {
        return view('user.gacha.list');
    }
    
    public function brunch(Request $request)
    {
        // プライズリストへ
        if(isset($request->gacha_prize)){
            return view('user.gacha.prize.list');
            
        // ガチャを引くページへ
        }elseif(isset($request->gacha_play)){
            return view('gacha.play');
            
            
        // ガチャを削除する場合
        }elseif(isset($request->delete_gacha_id)){
            $this->delete();
        }
        return view('user.gacha.list');
    }
    
    public function add()
    {
        return view('user.gacha.create');
    }
    
    public function create()
    {
        return redirect('user/gacha/list');
    }
    
    public function edit()
    {
        return view('user.gacha.edit');
    }
    
    public function update()
    {
        return redirect('user/gacha/list');
    }
    
    public function delete()
    {
        return redirect('user/gacha/list'); 
    }
}
