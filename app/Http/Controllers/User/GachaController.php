<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGacha;
use App\Http\Requests\EditGacha;
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
            $gachas = Gacha::where('user_id', Auth::id())->get();
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
    
    
    public function edit(Request $request)
    {
        $gacha = Gacha::find($request->gacha_id);
        
        if(empty($gacha)){
            return('top');
        }
        
        return view('gacha_create.gacha.edit', ['gacha' => $gacha]);
    }
    
    public function update(EditGacha $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        
        $gacha = Gacha::find($request->id);
        // \Debugbar::info($gacha);
        
        $form = $request->all();
        
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $gacha->image_path = basename($path);
            unset($form['image']);
        }elseif(isset($request->remove)){
            $gacha->image_path =null;
            unset($form['image']);
        }
        unset($form['_token']);
        
        $gacha->fill($form)->save();
        
        // ガチャリストに戻るために必要なこと
        $cond_gacha_name = "";
        $gachas = Gacha::where('user_id', Auth::id())->get();
        $rarities = Rarity::all();
        
        return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
        
    }
    
    public function delete(Request $request)
    {
        // ガチャリストに戻るために必要なこと
        $cond_gacha_name = "";
        $gachas = Gacha::where('user_id', Auth::id())->get();
        $rarities = Rarity::all();
        
        
        // 削除機能ここから
        $gachas_id = $request->gacha_id;
        // \Debugbar::info($gachas_id);
        
        //  何もチェックせずにボタンが押された場合の処理
        if($gachas_id == null){
            return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
        }
        
        $delete_count = count($gachas_id);
        
        // テーブルからガチャを削除する
        for($i = 0; $i < $delete_count; $i++){
            $gacha = Gacha::find($gachas_id[$i]);
            $gacha->delete();
        }
        
        return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
    }
}
