<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RarityController extends Controller
{
    public function index()
    {
        return view('admin.rarity.list');
    }
    
    public function add()
    {
        return view('admin.rarity.create');
    }
    
    public function create(Request $request)
    {
        //$this->validate($request, Rarity::$rules);
        
        //$rarity = new Rarity;
        //$form = $request->all();
        
        //unset($form['_token']);
        
        //$rarity->fill($form)->save();
        
        if(isset($request->to_list)){
            return view('admin.rarity.list');
        }elseif(isset($request->cont)){
            return view('admin.rarity.create');
        }
        return view('admin.rarity.list');
    }
}
