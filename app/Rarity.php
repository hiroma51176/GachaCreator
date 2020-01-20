<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'rarity_name' => 'required | max: 30',
        );
        
    public function prizes()
    {
        return $this->hasmany('App\Prize');
    }
}
