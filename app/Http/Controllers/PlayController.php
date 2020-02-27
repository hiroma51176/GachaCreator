<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gacha;
use App\Prize;
// use App\Rarity;
use App\GachaHistory;
use Illuminate\Support\Facades\Auth;
use App\Lib\My_func;

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
        My_func::emptyGachaId($gacha);
        
        // URLにガチャidを直接入力して飛んできて、プライズが０種のガチャの場合はトップページに遷移させる
        My_func::zeroPrize($gacha);
        
        return view('gacha_play.play', ['gacha' => $gacha]);
    }
    
    // 「１回引く」
    public function playOneShot(Request $request)
    {
        $results_ten_shot = null;
        
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを直接入力し、gacha_idがないときはトップページへ移動する
        My_func::emptyGachaId($gacha);
        
        // URLにガチャidを直接入力して飛んできて、プライズが０種のガチャの場合はトップページに遷移させる
        My_func::zeroPrize($gacha);
        
        // プライズを取り出す
        list($miss, $hit, $jackpot) = My_func::getPrize($gacha);
        
        
        $result_one_shot = My_func::drawGacha($gacha, $miss, $hit, $jackpot);
        
        return view('gacha_play.result', ['gacha' => $gacha, 'result_one_shot' => $result_one_shot, 'results_ten_shot' => $results_ten_shot]);
    }
    
    // 「１０回引く」
    public function playTenShot(Request $request)
    {
        $result_one_shot = null;
        $results = null;
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを直接入力し、gacha_idがないときはトップページへ移動する
        My_func::emptyGachaId($gacha);
        
        // URLにガチャidを直接入力して飛んできて、プライズが０種のガチャの場合はトップページに遷移させる
        My_func::zeroPrize($gacha);
        
        // プライズを取り出す
        list($miss, $hit, $jackpot) = My_func::getPrize($gacha);
        
        // １０回繰り返す
        for($i = 1; $i <= 10; $i++){
            
            // 結果を配列に入れる
            $results[] = My_func::drawGacha($gacha, $miss, $hit, $jackpot);
            
        }
        
        // 配列$resultsを5個ずつ分割する
        $results_ten_shot = array_chunk($results, 2);
        
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
    
}
