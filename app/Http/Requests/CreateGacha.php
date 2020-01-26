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
            'jackpot_rate' => 'required | max: 100',
            'hit_rate' => 'required | max: 100',
            'miss_rate' => 'required | max: 100',
            'play_price' => 'required | max: 1000',
            'templete' => 'required',
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            if($this->jackpot_rate + $this->hit_rate + $this->miss_rate != 100){
                $validator->errors()->add('field', '排出率が合計で100になるように入力してください');
            }
        });
    }
}
