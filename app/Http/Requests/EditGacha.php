<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGacha extends FormRequest
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
            'gacha_name_count' => 'required | integer | max: 30',
            'gacha_description' => 'max: 60',
            'gacha_description_count' => 'integer | max: 60',
            'image' => 'image | max: 2000',
            'play_price' => 'required | integer | max: 10000',
            'jackpot_rate' => 'required | integer | max: 100',
            'hit_rate' => 'required | integer | max: 100',
            'miss_rate' => 'required | integer | max: 100',
        ];
    }
    
    public function prepareForValidation()
    {
        // 全角を2としてカウントするための処理
        $this->merge(['gacha_name_count' => strlen( mb_convert_encoding($this->gacha_name, 'SJIS', 'UTF-8'))]);
        $this->merge(['gacha_description_count' => strlen( mb_convert_encoding($this->gacha_description, 'SJIS', 'UTF-8'))]);
    }
    
    public function messages()
    {
        // エラーメッセージのカスタマイズ
        return [
            'gacha_name_count.max' => 'ガチャの名前 は30文字以下にしてください',
            'gacha_description_count.max' => 'ガチャの説明 は60文字以下にしてください',
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
        });
    }
}
