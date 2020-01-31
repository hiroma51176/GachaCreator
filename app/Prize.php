<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'prize_name' => 'required | max: 30',
        'rarity_name' => 'required',
        );
        
    public function gacha()
    {
        return $this->belongsTo('App\Gacha');
    }
    
    // public function rarity()
    // {
    //     return $this->belongsTo('App\Rarity');
    // }
    
    public function gacha_histories()
    {
        return $this->hasmany('App\GachaHistory');
    }
}
