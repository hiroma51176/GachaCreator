<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gacha;
use App\Prize;
// use App\Rarity;
use App\GachaHistory;
use Illuminate\Support\Facades\Auth;

class PlayController extends Controller
{
    public function top()
    {
        return view('top');
    }
    
    public function index(Request $request)
    {
        // 検索機能
        $cond_gacha_name = $request->cond_gacha_name;
        if($cond_gacha_name != ""){
            // 入力された値を検索 部分一致
            $gachas = Gacha::where('gacha_name', 'LIKE', "%{$cond_gacha_name}%")->paginate(10);
        }else{
            $gachas = Gacha::paginate(10);
        }
        
        return view('gacha_play.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name]);
    }
    
    public function viewPlay(Request $request)
    {
        
        $gacha_id = $request->gacha_id;
        
        $gacha = Gacha::find($gacha_id);
        
        
        // URLにガチャidを直接入力して飛んできて、存在しないidの場合はトップページに遷移させる
        if($gacha == null){
            return view('top');
        }
        
        // URLにガチャidを直接入力して飛んできて、プライズが０種のガチャの場合はトップページに遷移させる
        if($gacha->prizes->isEmpty()){
            return view('top');
        }
        // \Debugbar::info($prize);
        
        return view('gacha_play.play', ['gacha' => $gacha]);
    }
    
    // 「１回引く」
    public function playOneShot(Request $request)
    {
        $results_ten_shot = null;
        
        $gacha = Gacha::find($request->gacha_id);
        // \Debugbar::info($gacha);
        
        // プライズを取り出す
        $prizes = $gacha->prizes;
        
        $miss = $gacha->prizes->where('rarity_name', "はずれ");
        $hit = $gacha->prizes->where('rarity_name', "当たり");
        $jackpot = $gacha->prizes->where('rarity_name', "大当たり");
        
        // ガチャを引く
        $rand = mt_rand(1, 100);
        
        // 大当たりの場合
        if($rand <= $gacha->jackpot_rate){
            // $jackpotが空でない場合
            if($jackpot->isNotEmpty()){
                $result_one_shot = $jackpot->random();
            // 空の場合、全てのプライズから引く
            }else{
                $result_one_shot = $prizes->random();
            }
            
        }elseif($rand <= $gacha->hit_rate){
            if($hit->isNotEmpty()){
                $result_one_shot = $hit->random();
            }else{
                $result_one_shot = $prizes->random();
            }
            
        }else{
            if($miss->isNotEmpty()){
                $result_one_shot = $miss->random();
            }else{
                $result_one_shot = $prizes->random();
            }
        }
        $gacha->total_play_count += 1;
        $gacha->save();
        
        // ログインしているならガチャ結果をgacha_histories tableへ保存
        if(Auth::check()){
            $gacha_history = new GachaHistory;
            $gacha_history->user_id = Auth::id();
            $gacha_history->gacha_id = $gacha->id;
            $gacha_history->prize_id = $result_one_shot->id;
            $gacha_history->play_count += 1;
            $gacha_history->play_price += $gacha->play_price;
            $gacha_history->save();
        }
        
        // \Debugbar::info($result_one_shot);
        
        
        return view('gacha_play.result', ['gacha' => $gacha, 'result_one_shot' => $result_one_shot, 'results_ten_shot' => $results_ten_shot]);
    }
    
    // 「１０回引く」
    public function playTenShot(Request $request)
    {
        $result_one_shot = null;
        $results = null;
        $gacha = Gacha::find($request->gacha_id);
        
        
        // プライズを取り出す
        $prizes = $gacha->prizes;
        
        $miss = $gacha->prizes->where('rarity_name', "はずれ");
        $hit = $gacha->prizes->where('rarity_name', "当たり");
        $jackpot = $gacha->prizes->where('rarity_name', "大当たり");
        
        // １０回繰り返す
        for($i = 1; $i <= 10; $i++){
            $rand = mt_rand(1, 100);
        
            // 大当たりの場合
            if($rand <= $gacha->jackpot_rate){
                // $jackpotが空でない場合
                if($jackpot->isNotEmpty()){
                    $result = $jackpot->random();
                // 空の場合、全てのプライズから引く
                }else{
                    $result = $prizes->random();
                }
                
            // 当たりの場合
            }elseif($rand <= $gacha->hit_rate){
                if($hit->isNotEmpty()){
                    $result = $hit->random();
                }else{
                    $result = $prizes->random();
                }
                
            // はずれの場合
            }else{
                if($miss->isNotEmpty()){
                    $result = $miss->random();
                }else{
                    $result = $prizes->random();
                }
            }
            // ログインしているならガチャ結果をgacha_histories tableへ保存
            if(Auth::check()){
                $gacha_history = new GachaHistory;
                $gacha_history->user_id = Auth::id();
                $gacha_history->gacha_id = $gacha->id;
                $gacha_history->prize_id = $result->id;
                $gacha_history->play_count += 1;
                $gacha_history->play_price += $gacha->play_price;
                $gacha_history->save();
            }
            
            // 履歴に入れるためにここで結果を配列に入れる
            $results[] = $result;
        }
        // ガチャを引かれた回数を加算
        $gacha->total_play_count += 10;
        $gacha->save();
        // 配列$resultsを5個ずつ分割する
        $results_ten_shot = array_chunk($results, 2);
        // \Debugbar::info($results_ten_shot);
        
        return view('gacha_play.result', ['gacha' => $gacha, 'result_one_shot' => $result_one_shot, 'results_ten_shot' => $results_ten_shot]);
    }
    
    public function terms()
    {
        return view('terms_of_service');
    }
    
    public function policy()
    {
        return view('privacy_policy');
    }
    
    
    // public function viewCalculation()
    // {
    //     return view('gacha.calculation');
    // }
    
    // public function runCalculation()
    // {
    //     return view('gacha.calculation');
    // }
}
