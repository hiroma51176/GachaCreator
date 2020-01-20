<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGacha;
use App\Gacha;
use Illuminate\Support\Facades\Auth;
use App\Rarity;

class GachaController extends Controller
{
    public function index(Request $request)
    {
        // 検索機能
        $cond_gacha_name = $request->cond_gacha_name;
        if($cond_gacha_name != ""){
            // 入力された値を検索 部分一致
            $gachas = Gacha::where('user_id', Auth::id())->where('gacha_name', 'LIKE', "%{$cond_gacha_name}%")->get();
        }else{
            $gachas = Gacha::all();
        }
        $rarities = Rarity::all();
        
        return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
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
    
    public function create(CreateGacha $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        
        $gacha = new Gacha;
        $form = $request->all();
        
        
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $gacha->image_path = basename($path);
        }else{
            $gacha->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        unset($form['templete']);
        
        $gacha->user_id = Auth::id();
        
        $gacha->fill($form)->save();
        
        // ガチャidを取り出したい
        $gacha_data = Gacha::where('user_id', $gacha->user_id)->latest()->first();
        
        // テンプレートを使用しない場合はプライズ作成画面へ遷移
        if($request->templete == 0){
            return view('gacha_create.prize.create', ['gacha_id' => $gacha_data['id'], 'gacha_name' => $gacha_data['gacha_name']]);
            
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
