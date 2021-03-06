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
    Route::get('play/result_one_shot', 'PlayController@playOneShot');
    Route::get('play/result_ten_shot', 'PlayController@playTenShot');
});

// // シミュレーション関係
Route::get('simulation', 'SimulationController@front');
Route::post('simulation', 'SimulationController@run');


// まとめて'middleware' => 'auth' にする
Route::group(['prefix' => 'gacha_create', 'middleware' => 'auth'], function(){
    // ガチャ作成関係
    Route::get('gacha/list', 'User\GachaController@index');
    
    Route::get('gacha/create', 'User\GachaController@add');
    Route::post('gacha/create', 'User\GachaController@create');
    
    Route::get('gacha/edit', 'User\GachaController@edit');
    Route::post('gacha/edit', 'User\GachaController@update');
    
    Route::post('gacha/delete', 'User\GachaController@delete');
    
    // ガチャのプライズ作成関係
    Route::get('prize/list', 'User\PrizeController@index')->name('prize_list');
    
    Route::get('prize/create', 'User\PrizeController@add');
    Route::post('prize/create', 'User\PrizeController@create');
    
    Route::get('prize/edit', 'User\PrizeController@edit');
    Route::post('prize/edit', 'User\PrizeController@update');
    
    Route::post('prize/delete', 'User\PrizeController@delete');
    
    Route::get('history', 'User\GachaController@history');
});

Route::get('/', 'PlayController@top');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    // レアリティ関係、不使用
    // Route::get('rarity/list', 'Admin\RarityController@index');
    // Route::get('rarity/create', 'Admin\RarityController@add');
    // Route::post('rarity/create', 'Admin\RarityController@create');
    // Route::get('rarity/edit', 'Admin\RarityController@edit');
    // Route::post('rarity/edit', 'Admin\RarityController@update');
    
    // テンプレート関係
    // Route::get('templete/list', 'Admin\TempleteController@index');
    // Route::get('templete/create', 'Admin\TempleteController@add');
    // Route::post('templete/create', 'Admin\TempleteController@create');
// });

Route::get('terms', 'PlayController@terms');
Route::get('policy', 'PlayController@policy');

Route::group(['middleware' => 'auth'], function(){
    Route::get('profile', 'User\UserController@edit');
    Route::post('profile', 'User\UserController@update');
});

