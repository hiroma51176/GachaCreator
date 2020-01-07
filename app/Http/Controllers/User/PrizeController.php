<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrizeController extends Controller
{
    public function index()
    {
        return view('user.gacha.prize');
    }
    
    public function add()
    {
        return view('user.gacha.prize.create');
    }
    
    public function create()
    {
        return redirect('user/gacha/prize');
    }
    
    public function edit()
    {
        return view('user.gacha.prize.edit');
    }
    
    public function update()
    {
        return redirect('user/gacha/prize');
    }
    
    public function delete()
    {
        return redirect('user/gacha/prize');
    }
}
