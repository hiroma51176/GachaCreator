<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gacha extends Model
{
    protected $guarded = array('id');
    
    //public static $rules = array(
        //'user_id' => 'required',
        //'gacha_name' => 'required | max: 30',
        //'jackpot_rate' => 'required | max: 100',
        //'hit_rate' => 'required | max: 100',
        //'miss_rate' => 'required | max: 100',
        //'play_price' => 'max: 1000',
        //);
        
    public function rules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'gacha_name' => 'required | max: 30',
            'jackpot_rate' => 'required | max: 100',
            'hit_rate' => 'required | max: 100',
            'miss_rate' => 'required | max: 100',
            'play_price' => 'max: 1000',
            ]);
        
        $form = $request->all();
        $validator->after(function ($validator){
            if($form['jackpot_rate'] + $form['hit_rate'] + $form['miss_rate'] != 100){
                $validator->errors()->add('field', '排出率が合計で100になるように入力してください');
            }
        });
        
    }
}
