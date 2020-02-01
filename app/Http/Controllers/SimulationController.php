<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function front()
    {
        $result = null;
        return view('simulation.top', ['result' => $result]);
    }
    
    public function run(Request $request)
    {
            
            // バリデーションを設定
            $this->validate($request, [
                'play_price' => 'required | integer | between: 0, 10000',
                'rate' => 'required | integer | between: 1, 100',
                'max_play_count' => 'required | integer | between: 1, 1000',
            ]);
            
            $play_price = $request->play_price;
            $rate = $request->rate;
            $max_play_count = $request->max_play_count;
        
        
        // 入力された最大試行回数まで繰り返す
        for($i = 1; $i <= $max_play_count; $i++){
            // 1～100の数値を一つランダムで取得
            $gacha = mt_rand(1, 100);
            
            // 当たりを引いた場合
            if($gacha <= $rate){
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
        
        return view('simulation.top', ['result' => $result, 'play_price' => $play_price, 'rate' => $rate, 'max_play_count' => $max_play_count]);
    }
}
