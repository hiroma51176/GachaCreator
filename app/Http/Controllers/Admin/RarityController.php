<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rarity;
use Illuminate\Support\Facades\Auth;

class RarityController extends Controller
{
    public function index()
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
        $rarities = Rarity::all();
        return view('admin.rarity.list', ['rarities' => $rarities]);
    }
    
    public function add()
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
        return view('admin.rarity.create');
    }
    
    public function create(Request $request)
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
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
    
    public function edit(Request $request)
    {
        $rarity = Rarity::find($request->rarity_id);
        
        return view('admin.rarity.edit', ['rarity' => $rarity]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Rarity::$rules);
        
        $rarity = Rarity::find($request->id);
        $rarity->rarity_name = $request->rarity_name;
        $rarity->save();
        
        $rarities = Rarity::all();
        
        return view('admin.rarity.list',['rarities' => $rarities]);
    }
    
}
