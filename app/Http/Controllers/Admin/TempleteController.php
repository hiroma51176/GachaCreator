<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Templete;
use App\Gacha;
use App\Prize;

class TempleteController extends Controller
{
    public function index()
    {
        $templetes = Templete::all();
        
        return view('admin.templete.list', ['templetes' => $templetes]);
    }
    
    public function add()
    {
        $gachas = Gacha::where('user_id', 1)->get();
        
        return view('admin.templete.create', ['gachas' => $gachas]);
    }
    
    public function create(Request $request)
    {
        $prizes = Prize::where('gacha_id', $request->gacha_id)->get();
        
        foreach($prizes as $prize){
            $templete = new Templete;
            $templete->rarity_id = $prize->rarity_id;
            $templete->prize_name = $prize->prize_name;
            $templete->save();
        }
        
        $templetes = Templete::all();
        
        return view('admin.templete.list', ['templetes' => $templetes]);
    }
}
