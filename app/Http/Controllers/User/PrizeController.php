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
        
        // $gacha_id = $request->gacha_id;
        // $gacha_name = $request->gacha_name;
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを入力し、直接アクセスしてきた場合の処理
        My_func::emptyGachaId($gacha);
        // if(empty($gacha)){
        //     return view('top');
        // }
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        My_func::differentUserId($gacha);
        // if(Auth::id() != $gacha->user_id){
        //     return view('top');
        // }
        
        // 検索機能
        $cond_prize_name = $request->cond_prize_name;
        if($cond_prize_name != ""){
            // 入力された値を検索 部分一致
            $prizes = Prize::where('gacha_id', $request->gacha_id)->where('prize_name', 'LIKE', "%{$cond_prize_name}%")->paginate(5);
        }else{
            $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(5);
        }
        
        return view('gacha_create.prize.list', ['prizes' => $prizes, 'cond_prize_name' => $cond_prize_name, 'gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function add(Request $request)
    {
        $gacha = Gacha::find($request->gacha_id);
        
        // URLを入力し、直接アクセスしてきた場合の処理
        My_func::emptyGachaId();
        // if(empty($gacha)){
        //     return view('top');
        // }
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        My_func::differentUserId();
        // if(Auth::id() != $gacha->user_id){
        //     return view('top');
        // }
        
        //$gacha_id = $request->gacha_id;
        //$gacha_name = $request->gacha_name;
        
        // // URLで直接飛んできたとき
        // if(empty($gacha->id)){
        //     return view('top');
        // }
        return view('gacha_create.prize.create', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function create(CreatePrize $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        // $this->validate($request, Prize::$rules);
        
        $prize = new Prize;
        \Debugbar::info($prize->id);
        // $form = $request->all();
        $gacha_name = $request->gacha_name;
        $prize->prize_name = $request->prize_name;
        $prize->gacha_id = $request->gacha_id;
        
        if(isset($form['image'])){
            My_func::saveImagePrize($request, $prize);
            // $image_file = $request->file('image');
            // $now = date_format(Carbon::now(), 'YmdHis');
            // // アップロードされたファイル名を取得
            // $name = $image_file->getClientOriginalName();
            // $storePath = Auth::id() . '_' . $request->gacha_id . '_prize_' . $now . '_' . $name;
            // // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
            // $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
            // // s3へ保存
            // $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
            // $prize->image_path = Storage::disk('s3')->url($storePath);
            // // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // // $prize->image_path = Storage::disk('s3')->url($path);
            // // $path = $request->file('image')->store('public/image');
            // // $prize->image_path = basename($path);
        }else{
            $prize->image_path = null;
        }
        
        // unset($form['_token']);
        // unset($form['image']);
        // unset($form['gacha_name']);
        // unset($form['to_list']);
        // unset($form['cont']);
        // unset($form[('prize_name_count')]);
        
        // $prize->fill($form);
        
        // レアリティの処理
        $prize->rarity_name = My_func::rarityName($request->rarity_name);
        // switch ($request->rarity_name){
        //     case 1:
        //         $prize->rarity_name = "はずれ";
        //         break;
        //     case 2:
        //         $prize->rarity_name = "当たり";
        //         break;
        //     case 3:
        //         $prize->rarity_name = "大当たり";
        //         break;
        // }
        
        $prize->save();
        
        $gacha_id = $prize->gacha_id;
        
        // 追加してリストに戻る場合
        if(isset($request->to_list)){
            // リストに戻るために必要なこと
            // $cond_prize_name = null;
            $prizes = Prize::where('gacha_id', $prize->gacha_id)->paginate(10);
            return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'prizes' => $prizes]);
            // return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
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
        if(empty($prize)){
            return view('top');
        }
        
        //$gacha_id = $request->gacha_id;
        $gacha = Gacha::find($request->gacha_id);
        
        // 作成者以外のユーザーのプライズにアクセスできないようにする
        if(Auth::id() != $gacha->user_id){
            return view('top');
        }
        
        //$gacha_name = $request->gacha_name;
        
        return view('gacha_create.prize.edit', ['prize' => $prize, 'gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]);
    }
    
    public function update(EditPrize $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        // $this->validate($request, Prize::$rules);
        
        $prize = Prize::find($request->id);
        $form = $request->all();
        
        if(isset($form['image'])){
            $image_file = $request->file('image');
            $now = date_format(Carbon::now(), 'YmdHis');
            // アップロードされたファイル名を取得
            $name = $image_file->getClientOriginalName();
            $storePath = Auth::id() . '_' . $request->gacha_id . '_prize_' . $now . '_' . $name;
            // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
            $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
            // s3へ保存
            $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
            $prize->image_path = Storage::disk('s3')->url($storePath);
            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // $prize->image_path = Storage::disk('s3')->url($path);
            // $path = $request->file('image')->store('public/image');
            // $prize->image_path = basename($path);
            // unset($form['image']);
        }elseif(isset($request->remove)){
            $prize->image_path =null;
            unset($form['remove']);
        }
        unset($form['_token']);
        unset($form['image']);
        unset($form['gacha_id']);
        unset($form['gacha_name']);
        unset($form['prize_name_count']);
        
        $prize->fill($form);
        
        switch ($request->rarity_name){
            case 1:
                $prize->rarity_name = "はずれ";
                break;
            case 2:
                $prize->rarity_name = "当たり";
                break;
            case 3:
                $prize->rarity_name = "大当たり";
                break;
        }
        
        $prize->save();
        
        // プライズリストに戻るために必要なこと
        $gacha_id = $request->gacha_id;
        $gacha_name = $request->gacha_name;
        // $cond_prize_name = "";
        $prizes = Prize::where('gacha_id', $request->gacha_id)->paginate(10);
        
        return view('gacha_create.prize.list', ['prizes' => $prizes, 'prize' => $prize, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
        // return view('gacha_create.prize.list', ['prizes' => $prizes, 'cond_prize_name' => $cond_prize_name, 'prize' => $prize, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]);
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
        
        return redirect('gacha_create/gacha/list');
        // return view('gacha_create.prize.list', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name, 'cond_prize_name' => $cond_prize_name, 'prizes' => $prizes]);
    }
}
