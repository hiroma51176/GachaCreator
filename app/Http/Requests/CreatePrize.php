<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrize extends FormRequest
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
            'prize_name' => 'required',
            'prize_name_count' => 'required | integer | max: 30',
            'rarity_name' => 'required',
            'image' => 'image | max: 2000',
        ];
    }
    
    public function prepareForValidation()
    {
        // 全角を2としてカウントするための処理
        $this->merge(['prize_name_count' => strlen( mb_convert_encoding($this->prize_name, 'SJIS', 'UTF-8'))]);
    }
    
    public function messages()
    {
        // エラーメッセージのカスタマイズ
        return [
            'prize_name_count.max' => 'プライズの名前 は30文字以下にしてください',
        ];
    }
}
