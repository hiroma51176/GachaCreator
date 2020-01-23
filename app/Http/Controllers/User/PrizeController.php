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
            $prizes = Prize::where('gacha_id', $request->gacha_id)->where('prize_name', 'LIKE', "%{$cond_prize_name}%")->get();
        }else{
            $prizes = Prize::where('gacha_id', $request->gacha_id)->get();
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
            $cond_prize_name = null;
            $prizes = Prize::where('gacha_id', $prize->gacha_id)->get();
            return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
        }
            
        // 続けて追加する場合
        elseif(isset($request->cont)){
            return view('gacha_create.prize.create', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
        }
        return view('gacha_create.prize.list');
    }
    
    public function edit()
    {
        return view('gacha_create.prize.edit');
    }
    
    public function update()
    {
        return view('gacha_create.prize.list');
    }
    
    public function delete(Request $request)
    {
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        
        $prizes_id = $request->prize_id;
        
        // $gacha_id = Prize::find($prizes_id[0])->gacha->id;
        // $gacha_name = Prize::find($prizes_id[0])->gacha->gacha_name;
        
        $delete_count = count($prizes_id);
        // \Debugbar::info($delete_count);
        
        // プライズを削除する
        //for($i = 0; $i < $delete_count; $i++){
            //$prize = Prize::find($prizes_id[$i]);
            //$prize->delete();
        //}
        
        $cond_prize_name = null;
        if($cond_prize_name != ""){
            // 入力された値を検索 部分一致
            $prizes = Prize::where('gacha_id', $gacha_id)->where('prize_name', 'LIKE', "%{$cond_prize_name}%")->get();
        }else{
            $prizes = Prize::where('gacha_id', $gacha_id)->get();
        }
        
        return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
    }
}
