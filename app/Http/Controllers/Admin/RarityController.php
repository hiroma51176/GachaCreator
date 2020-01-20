<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rarity;

class RarityController extends Controller
{
    public function index()
    {
        $rarities = Rarity::all();
        return view('admin.rarity.list', ['rarities' => $rarities]);
    }
    
    public function add()
    {
        return view('admin.rarity.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Rarity::$rules);
        
        $rarity = new Rarity;
        $form = $request->all();
        
        unset($form['_token']);
        unset($form['to_list']);
        unset($form['cont']);
        
        $rarity->fill($form)->save();
        
        if(isset($request->to_list)){
            $rarities = Rarity::all();
            return view('admin.rarity.list',['rarities' => $rarities]);
            
        }elseif(isset($request->cont)){
            return view('admin.rarity.create');
        }
        return view('admin.rarity.list');
    }
}
