<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GachaHistory extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'user_id' => 'required',
        'gacha_id' => 'required',
        'prize_id' => 'required',
        );
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function gacha()
    {
        return $this->belongsTo('App\Gacha');
    }
    
    public function prize()
    {
        return $this->belongsTo('App\Prize');
    }
}
