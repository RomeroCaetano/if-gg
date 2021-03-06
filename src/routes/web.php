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

Route::resources([
    'summoner' => 'SummonerController',
    'match' => 'MatchsController'
]);

Route::middleware(['auth'])->group(function(){
    Route::resource('champion', 'ChampionsController')->only(['index','show']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
