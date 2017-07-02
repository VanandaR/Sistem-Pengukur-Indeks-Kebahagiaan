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

Route::get('/', function (){
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

Route::get('/ontology', 'OntologyController@index');
Route::post('/ontology/insert', 'OntologyController@insert');
Route::post('/ontology/update', 'OntologyController@update');
Route::get('/ontology/delete/{id}', ['uses'=> 'OntologyController@delete']);


Route::get('/datatraining/tabel', 'DataTrainingController@index');
//Route::get('/datatraining/manual', 'DataTrainingController@manual');
Route::get('/datatraining/delete/{id}', ['uses'=> 'DataTrainingController@delete']);
Route::get('/datatraining/edit/{id}', ['uses'=> 'DataTrainingController@edit']);
Route::post('/datatraining/update', 'DataTrainingController@update');
Route::get('/datatraining/preprocessing', 'DataTrainingController@textmining');
//Route::post('/datatraining/manual/label', 'DataTrainingController@labelling');

Route::get('/datatesting/tabel', 'DataTestingController@index');
Route::get('/datatesting/delete/{id}', ['uses'=> 'DataTestingController@delete']);
Route::get('/datatesting/preprocessing', 'DataTestingController@textmining');
Route::post('/datatesting/update', 'DataTestingController@update');
Route::get('/datatesting/edit/{id}', ['uses'=> 'DataTestingController@edit']);
//Route::get('/datatesting/manual', 'DataTestingController@manual');
//Route::post('/datatesting/manual/label', 'DataTestingController@labelling');
Route::get('/datatesting/klasifikasi', 'DataTestingController@klasifikasi');
Route::get('/datatesting/indekskebahagiaan', 'DataTestingController@indekskebahagiaan');

Route::get('/streaming', 'StreamingController@index');
Route::get('/streaming/visualisasi', 'StreamingController@visualisasi');

Route::post('/ahlibahasaclassification', 'TweetController@ahlibahasaclassification');

Route::get('/FAQ', 'FAQController@index');

Route::get('/user', 'UserController@index');

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/');
});