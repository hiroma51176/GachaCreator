<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function index()
    {
        return view('gacha');
    }
    
    public function play()
    {
        return view('gacha/play');
    }
    
    public function playOneShot()
    {
        return view('gahca/play');
    }
    
    public function playTenShot()
    {
        return view('gacha/play');
    }
    
    public function viewSimulation()
    {
        return view('gacha/simulation');
    }
    
    public function runSimulation()
    {
        return view('gacha/simulation');
    }
    
    public function viewCalculation()
    {
        return view('gacha/calculation');
    }
    
    public function runCalculation()
    {
        return view('gacha/calculation');
    }
}
