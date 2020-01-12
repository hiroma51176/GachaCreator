<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function top()
    {
        return view('layouts.top');
    }
    
    public function index(Request $request)
    {
        // Modelを実装したらコメントアウトをやめる
        //$cond_gacha_name = $request->cond_gacha_name;
        //if($cond_gacha_name != ""){
            // 入力された値を検索 部分一致
            //$gachas = Gacha::where('gacha_name', 'LIKE', "%{$cond_gacha_name}%")->get();
        //}else{
            //$gachas = Gacha::all();
        //}
        
        // Modelを実装したらview()内に追加 , ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name']
        return view('gacha.list');
    }
    
    public function play()
    {
        return view('gacha.play');
    }
    
    public function playOneShot()
    {
        return view('gahca.play');
    }
    
    public function playTenShot()
    {
        return view('gacha.play');
    }
    
    public function viewSimulation()
    {
        $result = null;
        return view('gacha.simulation', ['result' => $result]);
    }
    
    public function runSimulation(Request $request)
    {
        // バリデーションを設定
        $this->validate($request,[
            'play_price' => 'required | integer | between: 1, 1000',
            'jackpot_rate' => 'required | integer | between: 1, 100',
            'max_play_count' => 'required | integer | between: 1, 1000',
        ]);
        
        // 入力された最大試行回数まで繰り返す
        for($i = 1; $i <= $request->max_play_count; $i++){
            // 1～100の数値を一つランダムで取得
            $gacha = mt_rand(1, 100);
            
            if($gacha <= $request->jackpot_rate){
                $play_count = $i;
                $i = $request->max_play_count;
            }else{
                $play_count = $request->max_play_count;
            }
        }
        
        $result['total_play_count'] = $play_count;
        $result['total_price'] = $play_count * $request->play_price;
        
        if($play_count == $request->max_play_count){
            $result['real_rate'] = 0.00;
        }else{
            $result['real_rate'] = round(1 / $play_count * 100, 2);
        }
        
        return view('gacha.simulation', ['result' => $result]);
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
