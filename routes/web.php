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

// ガチャを引く関係
Route::group(['prefix' => 'gacha_play'], function(){
    
    Route::get('list', 'PlayController@index');
    Route::get('play', 'PlayController@viewPlay');
    Route::post('play/result','PlayController@runPlay');
    Route::get('play/result_OneShot', 'PlayController@playOneShot');
    Route::get('play/result_TenShot', 'PlayController@playTenShot');
});

// // シミュレーション関係
Route::get('simulation', 'PlayController@viewSimulation');
Route::post('simulation', 'PlayController@runSimulation');

// 期待値計算関係 いずれ追加
// Route::get('calculation', 'PlayController@viewCalculation');
// Route::post('calculation', 'PlayController@runCalculation');

// まとめて'middleware' => 'auth' にする
Route::group(['prefix' => 'gacha_create'], function(){
    // ガチャ作成関係
    Route::get('gacha/list', 'User\GachaController@index');
    Route::post('gacha/list', 'User\GachaController@brunch');
    
    Route::get('gacha/create', 'User\GachaController@add');
    Route::post('gacha/create', 'User\GachaController@create');
    
    Route::get('gacha/edit', 'User\GachaController@edit');
    Route::post('gacha/edit', 'User\GachaController@update');
    
    Route::post('gacha/delete', 'User\GachaController@delete');
    
    // ガチャのプライズ作成関係
    Route::get('prize/list', 'User\PrizeController@index');
    
    Route::get('prize/create', 'User\PrizeController@add');
    Route::post('prize/create', 'User\PrizeController@create');
    
    Route::get('prize/edit', 'User\PrizeController@edit');
    Route::post('prize/edit', 'User\PrizeController@update');
    
    Route::post('prize/delete', 'User\PrizeController@delete');
});

Route::get('/', 'PlayController@top');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function(){
    // レアリティ関係
    Route::get('rarity/list', 'Admin\RarityController@index');
    Route::get('rarity/create', 'Admin\RarityController@add');
    Route::post('rarity/create', 'Admin\RarityController@create');
});

