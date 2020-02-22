<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGacha;
use App\Http\Requests\EditGacha;
use App\Gacha;
use Illuminate\Support\Facades\Auth;
// use App\Rarity;
use App\GachaHistory;
use App\Templete;
use App\Prize;
use Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class GachaController extends Controller
{
    public function index(Request $request)
    {
        // 検索機能
        $cond_gacha_name = $request->cond_gacha_name;
        if($cond_gacha_name != ""){
            // 入力された値を検索 部分一致
            $gachas = Gacha::where('user_id', Auth::id())->where('gacha_name', 'LIKE', "%{$cond_gacha_name}%")->paginate(10);
        }else{
            $gachas = Gacha::where('user_id', Auth::id())->paginate(10);
        }
        
        
        return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name]);
    }
    
    public function add()
    {
        $gacha_templetes = null;
        $gachas = Gacha::where('user_id', Auth::id())->get();
        
        // 「作成したガチャをコピーする」項目を表示する為の処理
        if($gachas != null){
            foreach($gachas as $gacha){
                $prizes = $gacha->prizes;
                // プライズが存在するガチャを$gacha_templeteに格納する
                if($prizes->isNotEmpty()){
                    $gacha_templetes[] = $gacha;
                }
            }
        }
        
        return view('gacha_create.gacha.create', ['gachas' => $gacha_templetes]);
    }
    
    public function create(CreateGacha $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        
        $gacha = new Gacha;
        $form = $request->all();
        
        
        if(isset($form['image'])){
            $gacha->image_path = My_func::saveImageGacha($request);
            // $image_file = $request->file('image');
            // $now = date_format(Carbon::now(), 'YmdHis');
            // // アップロードされたファイル名を取得
            // $name = $image_file->getClientOriginalName();
            // $storePath = Auth::id() . '_gacha_' . $now . '_' . $name;
            // // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
            // $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
            // // s3へ保存
            // $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
            // $gacha->image_path = Storage::disk('s3')->url($storePath);
            //$path = $request->file('image')->store('public/image');
            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // $gacha->image_path = Storage::disk('s3')->url($path);
            //$gacha->image_path = basename($path);
        }else{
            $gacha->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        unset($form['templete']);
        unset($form['gacha_name_count']);
        unset($form['gacha_description_count']);
        
        $gacha->user_id = Auth::id();
        
        $gacha->fill($form)->save();
        
        // ガチャidを取り出したい
        $gacha_data = Gacha::where('user_id', $gacha->user_id)->latest()->first();
        
        // テンプレートを使用しない場合はプライズ作成画面へ遷移
        if($request->templete == 0){
            return view('gacha_create.prize.create', ['gacha_id' => $gacha_data->id, 'gacha_name' => $gacha_data->gacha_name]);
            
        // 使用する場合はテンプレートの内容をコピーしてガチャリストへ遷移
        }elseif($request->templete == -1){
            // テンプレートを呼び出してコピーする処理を書く
            $templetes = Templete::all();
            
            // テンプレートのプライズをコピーする
            foreach($templetes as $templete){
                My_func::useTemplete($gacha_data->id, $templete);
                // $prize = new Prize;
                // $prize->gacha_id = $gacha_data->id;
                // $prize->rarity_name = $templete->rarity_name;
                // $prize->prize_name = $templete->prize_name;
                // $prize->save();
            }
            
        }else{
            // テンプレートとして選んだガチャのプライズを取り出す
            $templete_gacha = Gacha::find($request->templete);
            $templete_prizes = $templete_gacha->prizes;
            
            // コピーする
            foreach($templete_prizes as $templete_prize){
                My_func::useTemplete($gacha_data->id, $templete_prize);
                // $prize = new Prize;
                // $prize->gacha_id = $gacha_data->id;
                // $prize->rarity_name = $templete_prize->rarity_name;
                // $prize->prize_name = $templete_prize->prize_name;
                // $prize->save();
            }
            
        }
        
        return redirect('gacha_create/gacha/list');
        
    }
    
    
    public function edit(Request $request)
    {
        $gacha = Gacha::find($request->gacha_id);
        
        My_func::emptyGachaId($gacha);
        // if(empty($gacha)){
        //     return view('top');
        // }
        
        // 作成者以外のユーザーのガチャにアクセスできないようにする
        My_func::differentUserId($gacha);
        // if(Auth::id() != $gacha->user_id){
        //     return view('top');
        // }
        
        return view('gacha_create.gacha.edit', ['gacha' => $gacha]);
    }
    
    public function update(EditGacha $request)
    {
        // バリデーションをかける
        $validated = $request->validated();
        
        $gacha = Gacha::find($request->id);
        
        $form = $request->all();
        
        if(isset($form['image'])){
            $gacha->image_path = My_func::saveImageGacha($request);
            // $image_file = $request->file('image');
            // $now = date_format(Carbon::now(), 'YmdHis');
            // // アップロードされたファイル名を取得
            // $name = $image_file->getClientOriginalName();
            // $storePath = Auth::id() . '_gacha_' . $now . '_' . $name;
            // // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
            // $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
            // // s3へ保存
            // $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
            // $gacha->image_path = Storage::disk('s3')->url($storePath);
            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // $gacha->image_path = Storage::disk('s3')->url($path);
            // \Debugbar::info($gacha->image_path);
            // $path = $request->file('image')->store('public/image');
            // $gacha->image_path = basename($path);
        }elseif(isset($request->remove)){
            $gacha->image_path =null;
            unset($form['remove']);
        }
        unset($form['_token']);
        unset($form['image']);
        unset($form['gacha_name_count']);
        unset($form['gacha_description_count']);
        
        $gacha->fill($form)->save();
        
        // ガチャリストに戻るために必要なこと
        // $cond_gacha_name = "";
        // $gachas = Gacha::where('user_id', Auth::id())->paginate(10);
        
        // return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name]);
        return redirect('gacha_create/gacha/list');
        
    }
    
    public function delete(Request $request)
    {
        $gachas_id = $request->gacha_id;
        
        
        //  何もチェックせずにボタンが押された場合の処理
        if($gachas_id == null){
            return view('gacha_create.gacha.list', ['gachas' => $gachas, 'cond_gacha_name' => $cond_gacha_name]);
        }
        
        $delete_count = count($gachas_id);
        
        // テーブルからガチャを削除する
        for($i = 0; $i < $delete_count; $i++){
            $gacha = Gacha::find($gachas_id[$i]);
            $gacha->delete();
        }
        
        return redirect('gacha_create/gacha/list');
    }
    
    public function history()
    {
        // 最新１０件のプライズ獲得履歴を取り出す
        $gacha_histories = GachaHistory::where('user_id', Auth::id())->latest()->limit(10)->get();
        
        // ガチャを引いた数の累計
        $draw_count = GachaHistory::where('user_id', Auth::id())->count();
        // ガチャを引いた金額の累計
        $price_used = GachaHistory::where('user_id', Auth::id())->select('play_price')->sum('play_price');
        // \Debugbar::info($price_used);
        return view('history', ['gacha_histories' => $gacha_histories, 'price_used' => $price_used, 'draw_count' => $draw_count]);
    }
    
    
}
