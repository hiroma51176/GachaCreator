<?php
namespace App\Lib;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\GachaHistory;
use Storage;
use App\Templete;

class My_func
{
    // ガチャidがない場合はトップページに遷移する
    public static function emptyGachaId($gacha)
    {
        if(empty($gacha)){
            return view('top');
        }
    }
    
    // ユーザーidとガチャテーブルのユーザーidが異なる場合はトップページに遷移する
    public static function differentUserId($gacha)
    {
        if(Auth::id() != $gacha->user_id){
            return view('top');
        }
    }
    
    // プライズが0種の場合、トップページに遷移する
    public static function zeroPrize($gacha)
    {
        if($gacha->prizes->isEmpty()){
            return view('top');
        }
    }
    
    public static function notExistPrize($prize)
    {
        if(empty($prize)){
            return view('top');
        }
    }
    
    // プライズを取り出すための処理
    public static function getPrize($gacha)
    {
        $prizes = $gacha->prizes;
        
        $miss = $gacha->prizes->where('rarity_name', "はずれ");
        $hit = $gacha->prizes->where('rarity_name', "当たり");
        $jackpot = $gacha->prizes->where('rarity_name', "大当たり");
        
        return array($miss, $hit, $jackpot);
    }
    
    // ガチャを引くときの処理
    public static function drawGacha($gacha, $miss, $hit, $jackpot)
    {
        // プライズを取り出す
        // $prizes = $gacha->prizes;
        
        // $miss = $gacha->prizes->where('rarity_name', "はずれ");
        // $hit = $gacha->prizes->where('rarity_name', "当たり");
        // $jackpot = $gacha->prizes->where('rarity_name', "大当たり");
        
        // ガチャを引く
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
            
        }elseif($rand <= $gacha->hit_rate){
            if($hit->isNotEmpty()){
                $result = $hit->random();
            }else{
                $result = $prizes->random();
            }
            
        }else{
            if($miss->isNotEmpty()){
                $result = $miss->random();
            }else{
                $result = $prizes->random();
            }
        }
        $gacha->total_play_count += 1;
        $gacha->save();
        
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
        
        return $result;
    }
    
    // テンプレートを使用するときの処理
    public static function useTemplete($gacha_id, $templete)
    {
        $prize = new Prize;
        $prize->gacha_id = $gacha_id;
        $prize->rarity_name = $templete->rarity_name;
        $prize->prize_name = $templete->prize_name;
        $prize->image_path = $templete->image_path;
        $prize->save();
    }
    
    // s3へ画像を保存するときの処理（ガチャver）
    public static function saveImageGacha($request)
    {
        $image_file = $request->file('image');
        $now = date_format(Carbon::now(), 'YmdHis');
        // アップロードされたファイル名を取得
        $name = $image_file->getClientOriginalName();
        $storePath = 'gacha_image_' . 'user_id_' . Auth::id() . '_' . $now . '_' . $name;
        // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
        $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
        // s3へ保存
        $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
        $gacha->image_path = Storage::disk('s3')->url($storePath);
        
        return $gacha->image_path;
    }
    
    // s3へ画像を保存するときの処理（プライズver）
    public static function saveImagePrize($request, $prize)
    {
        $image_file = $request->file('image');
        $now = date_format(Carbon::now(), 'YmdHis');
        // アップロードされたファイル名を取得
        $name = $image_file->getClientOriginalName();
        $storePath = 'prize_image_' . 'user_id_' . Auth::id() . '_gacha_id_' . $prize->gacha_id . '_' . $now . '_' . $name;
        // 画像を横幅は300px、縦幅はアスペクト比維持の自動サイズへリサイズ
        $image = Image::make($image_file)->resize(300, null, function($constraint) {$constraint->aspectRatio(); });
        // s3へ保存
        $path = Storage::disk('s3')->put($storePath, (string)$image->encode(), 'public');
        $prize->image_path = Storage::disk('s3')->url($storePath);
        
        // return array($path, $prize->image_path);
        return $prize->image_path;
    }
    
    public static function rarityName($rarity_num)
    {
        switch ($rarity_num){
            case 1:
                $rarity_name = "はずれ";
                break;
            case 2:
                $rarity_name = "当たり";
                break;
            case 3:
                $rarity_name = "大当たり";
                break;
        }
        return $rarity_name;
    }
}