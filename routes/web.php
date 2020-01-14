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
    Route::post('play', 'PlayController@viewPlay');
    Route::post('play/result','PlayController@runPlay');
    //Route::get('play/result_OneShot', 'PlayController@playOneShot');
    //Route::get('play/result_TenShot', 'PlayController@playTenShot');
    
    // シミュレーション関係
    Route::get('simulation', 'PlayController@viewSimulation');
    Route::post('simulation', 'PlayController@runSimulation');
    
    // 期待値計算関係
    // Route::get('calculation', 'PlayController@viewCalculation');
    // Route::post('calculation', 'PlayController@runCalculation');
});

// まとめて'middleware' => 'auth' にする
Route::group(['prefix' => 'user'], function(){
    // ガチャ作成関係
    Route::get('gacha/list', 'User\GachaController@index');
    Route::post('gacha/list', 'User\GachaController@brunch');
    
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
