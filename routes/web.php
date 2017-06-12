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
    return view('landingpage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tweet', 'TweetController@index');
Route::post('/adddata', 'TweetController@adddata');

Route::get('/stopword', 'StopwordController@index');
Route::post('/stopword/insert', 'StopwordController@insert');
Route::post('stopword/update', 'StopwordController@update');
Route::get('/stopword/delete/{id}', ['uses'=> 'StopwordController@delete']);

Route::get('/sentiword', 'SentiwordController@index');
Route::post('/sentiword/insert', 'SentiwordController@insert');
Route::post('sentiword/update', 'SentiwordController@update');
Route::get('/sentiword/delete/{id}', ['uses'=> 'SentiwordController@delete']);

Route::get('/datatraining/tabel', 'TextMiningController@datatraining');
Route::get('/datatraining/lexicon', 'TextMiningController@datatraininglexicon');
Route::get('/datatraining/delete/{id}', ['uses'=> 'TextMiningController@deletedatatraining']);
Route::get('/datatraining/preprocessing', 'TextMiningController@textminingdatatraining');

Route::get('/datatesting/tabel', 'TextMiningController@datatesting');
Route::get('/datatesting/lexicon', 'TextMiningController@datatestinglexicon');
Route::get('/datatesting/delete/{id}', ['uses'=> 'TextMiningController@deletedatatesting']);
Route::get('/datatesting/preprocessing', 'TextMiningController@textminingdatatesting');

Route::post('/klasifikasi/update', 'TextMiningController@manuallabelling');
Route::get('/datatesting/klasifikasi', 'TextMiningController@klasifikasitesting');

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/');
});