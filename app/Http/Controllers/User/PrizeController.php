<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prize;
// use App\Rarity;
use App\Gacha;
use Illuminate\Support\Facades\Auth;
use Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Http\Requests\CreatePrize;
use App\Http\Requests\EditPrize;
use App\Lib\My_func;

class PrizeController extends Controller
{
    public function index(Request $request)
    {
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを入力し、直接アクセスしてきた場合の処理
        My_func::emptyGachaId($gacha);
        // \Debugbar::info($gacha);
        
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        My_func::differentUserId($gacha);
        
        // 検索機能
        $cond_prize_name = $request->cond_prize_name;
        if($cond_prize_name != ""){
            // 入力された値を検索 部分一致
            $prizes = Prize::where('gacha_id', $request->gacha_id)->where('prize_name', 'LIKE', "%{$cond_prize_name}%")->paginate(10);
        }else{
            $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(10);
        }
        
        return view('gacha_create.prize.list', ['prizes' => $prizes, 'cond_prize_name' => $cond_prize_name, 'gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function add(Request $request)
    {
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを入力し、直接アクセスしてきた場合の処理
        My_func::emptyGachaId($gacha);
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        My_func::differentUserId($gacha);
        
        return view('gacha_create.prize.create', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function create(CreatePrize $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        // $this->validate($request, Prize::$rules);
        
        $prize = new Prize;
        // \Debugbar::info($prize->id);
        $form = $request->all();
        $gacha_name = $request->gacha_name;
        $prize->prize_name = $request->prize_name;
        $prize->gacha_id = $request->gacha_id;
        
        if(isset($form['image'])){
            // $prize->image_path = My_func::saveImagePrize($request, $prize);
            $prize->image_path = My_func::saveImage($request);
            
        }else{
            $prize->image_path = null;
        }
        
        // レアリティの処理
        $prize->rarity_name = My_func::rarityName($request->rarity_name);
        
        $prize->save();
        
        $gacha_id = $prize->gacha_id;
        
        // 追加してリストに戻る場合
        if(isset($request->to_list)){
            $prizes = Prize::where('gacha_id', $prize->gacha_id)->paginate(10);
            
            // return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'prizes' => $prizes, 'data' => $data]);
            // return redirect('gacha_create/gacha/list');
            return redirect(route('prize_list',['prizes' => $prizes, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]));
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
        // \Debugbar::info($prize);
        
        // ＵＲＬ直接入力したとき、プライズが存在しない場合
        My_func::notExistPrize($prize);
        
        $gacha = Gacha::find($request->gacha_id);
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        My_func::differentUserId($gacha);
        
        return view('gacha_create.prize.edit', ['prize' => $prize, 'gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function update(EditPrize $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        // $this->validate($request, Prize::$rules);
        
        $prize = Prize::find($request->id);
        $prize->prize_name = $request->prize_name;
        $form = $request->all();
        
        
        if(isset($form['image'])){
            // $prize->image_path = My_func::saveImagePrize($request, $prize);
            $prize->image_path = My_func::saveImage($request);
            
        }elseif(isset($request->remove)){
            $prize->image_path =null;
            unset($form['remove']);
        }
        
        $prize->rarity_name = My_func::rarityName($request->rarity_name);
        
        $prize->save();
        
        // プライズリストに戻るために必要なこと
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        
        $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(10);
        
        // return view('gacha_create.prize.list', ['prizes' => $prizes, 'prize' => $prize, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
        return redirect(route('prize_list',['prizes' => $prizes, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]));
    }
    
    public function delete(Request $request)
    {
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        
        $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(10);
        
        $prizes_id = $request->prize_id;
        
        // 何もチェックせずにボタンが押された場合の処理
        if($prizes_id == null){
            return redirect('gacha_create/gacha/list');
        }
        
        $delete_count = count($prizes_id);
        
        // テーブルからプライズを削除する
        for($i = 0; $i < $delete_count; $i++){
            $prize = Prize::find($prizes_id[$i]);
            $prize->delete();
        }
        
        // return redirect('gacha_create/gacha/list');
        return redirect(route('prize_list',['prizes' => $prizes, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]));
    }
}
