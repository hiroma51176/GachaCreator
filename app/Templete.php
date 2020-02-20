<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templete extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'rarity_id' => 'required',
        'prize_name' => 'required',
        'image' => 'image | max: 2000',
        );
        
    // public function rarity()
    // {
    //     return $this->belongsTo('App\Rarity');
    // }
}
