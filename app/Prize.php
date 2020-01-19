<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'prize_name' => 'required | max: 60',
        );
}
