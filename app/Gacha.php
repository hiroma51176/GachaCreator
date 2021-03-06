<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gacha extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'user_id' => 'required',
        );
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function prizes()
    {
        return $this->hasmany('App\Prize');
    }
    
    public function gacha_histories()
    {
        return $this->hasmany('App\GachaHistory');
    }
}
