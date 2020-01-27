<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGacha;
use App\Http\Requests\EditGacha;
use App\Gacha;
use Illuminate\Support\Facades\Auth;
use App\Rarity;
use App\GachaHistory;
use App\Templete;
use App\Prize;

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
    
    
    public function add()
    {
        $gacha_templetes = null;
        $gachas = Gacha::where('user_id', Auth::id())->get();
        
        if($gachas != null){
            foreach($gachas as $gacha){
                $prizes = $gacha->prizes;
                // \Debugbar::info($prizes);
                if($prizes->isNotEmpty()){
                    $gacha_templetes[] = $gacha;
                }
            }
        }
        
        
        return view('gacha_create.gacha.create', ['gachas' => $gacha_templetes]);
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
            return view('gacha_create.prize.create', ['gacha_id' => $gacha_data->id, 'gacha_name' => $gacha_data->gacha_name]);
            
        // 使用する場合はテンプレートの内容をコピーしてガチャリストへ遷移
        }elseif($request->templete == -1){
            // テンプレートを呼び出してコピーする処理を書く
            $templetes = Templete::all();
            
            // テンプレートのプライズをコピーする
            foreach($templetes as $templete){
                $prize = new Prize;
                $prize->gacha_id = $gacha_data->id;
                $prize->rarity_id = $templete->rarity_id;
                $prize->prize_name = $templete->prize_name;
                $prize->save();
            }
            
            // ガチャリストに戻るために必要なこと
            $cond_gacha_name = "";
            $gachas = Gacha::where('user_id', Auth::id())->get();
            $rarities = Rarity::all();
            
            return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
            
        }else{
            // テンプレートとして選んだガチャのプライズを取り出す
            $templete_gacha = Gacha::find($request->templete);
            $templete_prizes = $templete_gacha->prizes;
            \Debugbar::info($templete_prizes);
            
            // コピーする
            foreach($templete_prizes as $templete_prize){
                $prize = new Prize;
                $prize->gacha_id = $gacha_data->id;
                $prize->rarity_id = $templete_prize->rarity_id;
                $prize->prize_name = $templete_prize->prize_name;
                $prize->save();
            }
            
            // ガチャリストに戻るために必要なこと
            $cond_gacha_name = "";
            $gachas = Gacha::where('user_id', Auth::id())->get();
            $rarities = Rarity::all();
            
            return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name, 'rarities' => $rarities]);
        }
        
        return view('top');
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
    
    public function history()
    {
        $gacha_histories = GachaHistory::where('user_id', Auth::id())->latest()->limit(10)->get();
        
        $price_used = GachaHistory::where('user_id', Auth::id())->select('play_price')->sum('play_price');
        // \Debugbar::info($price_used);
        return view('history', ['gacha_histories' => $gacha_histories, 'price_used' => $price_used]);
    }
}
