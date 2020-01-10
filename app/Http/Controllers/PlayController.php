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
        return view('gacha.simulation');
    }
    
    public function runSimulation()
    {
        return view('gacha.simulation');
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
