<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gacha;

class PlayController extends Controller
{
    public function top()
    {
        return view('top');
    }
    
    public function index(Request $request)
    {
        // Modelを実装したらコメントアウトをやめる
        $cond_gacha_name = $request->cond_gacha_name;
        if($cond_gacha_name != ""){
            // 入力された値を検索 部分一致
            $gachas = Gacha::where('gacha_name', 'LIKE', "%{$cond_gacha_name}%")->get();
        }else{
            $gachas = Gacha::all();
        }
        
        // Modelを実装したらview()内に追加 
        return view('gacha_play.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name]);
    }
    
    public function viewPlay()
    {
        return view('gacha_play.play');
    }
    
    // 「１回引く」と「１０回引く」で処理を分岐させる
    public function runPlay(Request $request)
    {
        // 「１回引く」
        if(isset($request->one_shot)){
            $this->playOneShot();
            
        // 「１０回引く」
        }elseif(isset($request->ten_shot)){
            $this->playTenShot();
            
        // 「それ以外（ＵＲＬ入力で直接とんできたとか？）」
        }else{
            return view('gacha_play.list');
        }
        
        return view('gacha_play.play');
    }
    
    // 「１回引く」
    public function playOneShot()
    {
        return view('gacha_play.play');
    }
    // 「１０回引く」
    public function playTenShot()
    {
        return view('gacha_play.play');
    }
    
    public function viewSimulation()
    {
        $result = null;
        return view('simulation.top', ['result' => $result]);
    }
    
    public function runSimulation(Request $request)
    {
            
            // バリデーションを設定
            $this->validate($request, [
                'play_price' => 'required | integer | between: 1, 1000',
                'jackpot_rate' => 'required | integer | between: 1, 100',
                'max_play_count' => 'required | integer | between: 1, 1000',
            ]);
            
            $play_price = $request->play_price;
            $jackpot_rate = $request->jackpot_rate;
            $max_play_count = $request->max_play_count;
        
        
        // 入力された最大試行回数まで繰り返す
        for($i = 1; $i <= $max_play_count; $i++){
            // 1～100の数値を一つランダムで取得
            $gacha = mt_rand(1, 100);
            
            // 当たりを引いた場合
            if($gacha <= $jackpot_rate){
                $play_count = $i;
                // $iに入力された最大試行回数を代入してfor文から抜ける
                $i = $max_play_count;
                
            // 当たりを引かなかった場合、$play_countに最大試行回数を代入
            }elseif($i == $max_play_count){
                $play_count = $max_play_count;
            }
        }
        
        $result['total_play_count'] = $play_count;
        $result['total_price'] = $play_count * $play_price;
        
        if($play_count == $max_play_count){
            $result['real_rate'] = 0.00;
        }else{
            $result['real_rate'] = round(1 / $play_count * 100, 2);
        }
        
        return view('simulation.top', ['result' => $result, 'play_price' => $play_price, 'jackpot_rate' => $jackpot_rate, 'max_play_count' => $max_play_count]);
    }
    
    public function viewCalculation()
    {
        return view('gacha.calculation');
    }
    
    public function runCalculation()
    {
        return view('gacha.calculation');
    }
}
