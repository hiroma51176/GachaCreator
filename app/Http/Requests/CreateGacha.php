<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGacha extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gacha_name' => 'required | max: 30',
            'gacha_describe' => 'max: 60',
            'image' => 'image | max: 2000',
            'play_price' => 'required | integer | max: 10000',
            'jackpot_rate' => 'required | integer | max: 100',
            'hit_rate' => 'required | integer | max: 100',
            'miss_rate' => 'required | integer | max: 100',
            //'templete' => 'required',
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            if(is_string($this->jackpot_rate) || is_string($this->hit_rate) || is_string($this->miss_rate)){
                // $validator->errors()->add('field', '排出率には整数を半角で入力してください');
            }elseif($this->jackpot_rate + $this->hit_rate + $this->miss_rate != 100){
                $validator->errors()->add('field', '排出率が合計で100になるように入力してください');
            }
            if($this->templete == ""){
                $validator->errors()->add('field', 'テンプレートの使用について選択してください');
            }
        });
    }
}
