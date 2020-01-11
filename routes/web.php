<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'gacha'], function(){
    // ガチャで遊ぶ関係
    Route::get('list', 'PlayController@index');
    Route::get('play', 'PlayController@play');
    Route::get('play/result_OneShot', 'PlayController@playOneShot');
    Route::get('play/result_TenShot', 'PlayController@playTenShot');
    
    // シミュレーション関係
    Route::get('simulation', 'PlayController@viewSimulation');
    Route::get('simulation/result', 'PlayController@runSimulation');
    
    // 期待値計算関係
    Route::get('calculation', 'PlayController@viewCalculation');
    Route::get('calculation/result', 'PlayController@runCalculation');
});

// まとめて'middleware' => 'auth' にする
Route::group(['prefix' => 'user'], function(){
    // ガチャ作成関係
    Route::get('gacha/list', 'User\GachaController@index');
    
    Route::get('gacha/create', 'User\GachaController@add');
    Route::post('gacha/create', 'User\GachaController@create');
    
    Route::get('gacha/edit', 'User\GachaController@edit');
    Route::post('gacha/edit', 'User\GachaController@update');
    
    Route::get('gacha/delete', 'User\GachaController@delete');
    
    // ガチャのプライズ作成関係
    Route::get('gacha/prize/list', 'User\PrizeController@index');
    
    Route::get('gacha/prize/create', 'User\PrizeController@add');
    Route::post('gacha/prize/create', 'User\PrizeController@create');
    
    Route::get('gacha/prize/edit', 'User\PrizeController@edit');
    Route::post('gacha/prize/edit', 'User\PrizeController@update');
    
    Route::get('gacha/prize/delete', 'User\PrizeController@delete');
});

Route::get('/', 'PlayController@top');