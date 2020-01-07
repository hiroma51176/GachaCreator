<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GachaController extends Controller
{
    public function index()
    {
        return view('user.gacha');
    }
    
    public function add()
    {
        return view('user.gacha.create');
    }
    
    public function create()
    {
        return redirect('user/gacha');
    }
    
    public function edit()
    {
        return view('user.gacha.edit');
    }
    
    public function update()
    {
        return redirect('user/gacha');
    }
    
    public function delete()
    {
        return redirect('user/gacha'); 
    }
}
