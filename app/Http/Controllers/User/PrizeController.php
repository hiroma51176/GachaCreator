<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prize;
use App\Rarity;

class PrizeController extends Controller
{
    public function index(Request $request)
    {
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        // 検索機能
        $cond_prize_name = $request->cond_prize_name;
        if($cond_prize_name != ""){
            // 入力された値を検索 部分一致
            $prizes = Prize::where('gacha_id', $request->gacha_id)->where('prize_name', 'LIKE', "%{$cond_prize_name}%")->paginate(5);
        }else{
            $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(5);
        }
        
        return view('gacha_create.prize.list', ['prizes' => $prizes, 'cond_prize_name' => $cond_prize_name, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
    }
    
    public function add(Request $request)
    {
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        
        if(empty($gacha_id)){
            return view('top');
        }
        return view('gacha_create.prize.create', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
    }
    
    public function create(Request $request)
    {
        // バリデーションをかける
        $this->validate($request, Prize::$rules);
        
        $prize = new Prize;
        $form = $request->all();
        
        $gacha_name = $request->gacha_name;
        
        $prize->gacha_id = $request->gacha_id;
        $prize->rarity_id = $request->rarity_id;
        
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $prize->image_path = basename($path);
        }else{
            $prize->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        unset($form['gacha_name']);
        unset($form['to_list']);
        unset($form['cont']);
        
        
        $prize->fill($form)->save();
        
        $gacha_id = $prize->gacha_id;
        
        // 追加してリストに戻る場合
        if(isset($request->to_list)){
            // リストに戻るために必要なこと
            $cond_prize_name = null;
            $prizes = Prize::where('gacha_id', $prize->gacha_id)->paginate(10);
            return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
        }
            
        // 続けて追加する場合
        elseif(isset($request->cont)){
            return view('gacha_create.prize.create', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
        }
        return view('gacha_create.prize.list');
    }
    
    public function edit(Request $request)
    {
        $prize= Prize::find($request->prize_id);
        \Debugbar::info($prize);
        
        if(empty($prize)){
            return('top');
        }
        
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        $rarities = Rarity::all();
        
        return view('gacha_create.prize.edit', ['prize' => $prize, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'rarities' => $rarities]);
    }
    
    public function update(Request $request)
    {
        // バリデーションをかける
        $this->validate($request, Prize::$rules);
        
        $prize = Prize::find($request->id);
        $form = $request->all();
        
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $prize->image_path = basename($path);
            unset($form['image']);
        }elseif(isset($request->remove)){
            $prize->image_path =null;
            unset($form['image']);
        }
        unset($form['_token']);
        unset($form['gacha_id']);
        unset($form['gacha_name']);
        
        $prize->fill($form)->save();
        
        // プライズリストに戻るために必要なこと
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        $cond_prize_name = "";
        $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(10);
        
        return view('gacha_create.prize.list', ['prizes' => $prizes, 'cond_prize_name' => $cond_prize_name, 'prize' => $prize, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
    }
    
    public function delete(Request $request)
    {
        // プライズリストに戻るために必要なこと
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        $cond_prize_name = "";
        $prizes = Prize::where('gacha_id', $gacha_id)->paginate(10);
        
        
        // 削除機能ここから
        $prizes_id = $request->prize_id;
        // \Debugbar::info($prizes_id);
        
        // 何もチェックせずにボタンが押された場合の処理
        if($prizes_id == null){
            return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
        }
        
        $delete_count = count($prizes_id);
        
        // テーブルからプライズを削除する
        for($i = 0; $i < $delete_count; $i++){
            $prize = Prize::find($prizes_id[$i]);
            $prize->delete();
        }
        
        return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
    }
}
