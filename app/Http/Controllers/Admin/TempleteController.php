<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Templete;
use App\Gacha;
use App\Prize;
use Illuminate\Support\Facades\Auth;

class TempleteController extends Controller
{
    public function index()
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
        $templetes = Templete::paginate(10);
        
        return view('admin.templete.list', ['templetes' => $templetes]);
    }
    
    public function add()
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
        $gachas = Gacha::where('user_id', 1)->get();
        
        return view('admin.templete.create', ['gachas' => $gachas]);
    }
    
    public function create(Request $request)
    {
        if(Auth::id() != 1){
            return redirect('');
        }
        
        Templete::query()->delete();
        
        $prizes = Prize::where('gacha_id', $request->gacha_id)->get();
        
        foreach($prizes as $prize){
            $templete = new Templete;
            $templete->rarity_name = $prize->rarity_name;
            $templete->prize_name = $prize->prize_name;
            $templete->save();
        }
        
        $templetes = Templete::paginate(10);
        
        return view('admin.templete.list', ['templetes' => $templetes]);
    }
}
