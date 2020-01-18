<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GachaController extends Controller
{
    public function index()
    {
        return view('gacha_create.gacha.list');
    }
    
    public function brunch(Request $request)
    {
        // プライズリストへ
        if(isset($request->prize)){
            
            // $request->gacha_idと紐づくPrizeモデルのデータを検索してデータを配列に入れてviewに渡す処理を書く
            
            return view('gacha_create.prize.list');
            
        // ガチャを引くページへ
        }elseif(isset($request->play)){
            
            // $request->gacha_idでGachaモデルを検索してそれの各パラメータを変数に入れてviewに渡す処理を書く
            
            return view('gacha_play.play');
            
        // ガチャを削除する場合
        }elseif(isset($request->delete)){
            // deleteアクションへ移動
            $this->delete();
        }
        return view('gacha_create.gacha.list');
    }
    
    public function add()
    {
        return view('gacha_create.gacha.create');
    }
    
    public function create(Request $request)
    {
        // バリデーションをかける
        //$this->validate($request, Gacha::$rules);
        
        $gacha = new Gacha;
        $form = $request->all();
        
        if($form['image']){
            $path = $request->file('image')->store('public/image');
            $gacha->image_path = basename($path);
        }else{
            $gacha->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        $gacha->fill($form)->save();
        
        // テンプレートを使用しない場合はプライズ作成画面へ遷移
        if($request->templete == 0){
            return view('gacha_create.prize.create');
            
        // 使用する場合はテンプレートの内容をコピーしてガチャリストへ遷移
        }elseif($request->templete == 1){
            
            // テンプレートを呼び出してコピーする処理を書く
            
            return view('gacha_create.gacha.list');
        }
        
        return view('gacha_create.gacha.list');
    }
    
    public function edit()
    {
        return view('gacha_create.gacha.edit');
    }
    
    public function update()
    {
        return view('gacha_create.gacha.list');
    }
    
    public function delete()
    {
        return view('gacha_create.gacha.list'); 
    }
}
