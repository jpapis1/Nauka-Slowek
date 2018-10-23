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

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () { // / is a home page resources/views
    return view('welcome');
});

Przykłady:

Route::get('/hello', function () { // / is a home page resources/views
    //return view('welcome');
    return 'Hello World';
});

Route::get('/about', function () { // / is a home page resources/views
    return view('pages.about');
});

Route::get('/users/{id}/{name}', function ($id,$name) { // / is a home page resources/views
    return 'To jest użytkownik ' . $name . ' z id ' . $id;
});

Route::get('/about', function () { // / is a home page resources/views
    return view('pages.about');
});
*/
Route::get('/','PagesController@main')->middleware('removeWordSetData');
Route::get('/login','PagesController@login')->middleware('removeWordSetData');
Route::get('/profile','KontoController@profile')->middleware('removeWordSetData');
Route::get('/register','PagesController@register')->middleware('removeWordSetData');
Route::get('/error','PagesController@error');

Route::get('/category/{name}', 'PagesController@showSubcategories')->middleware('removeWordSetData'); // kategoria
Route::get('/category/{kategoria}/{podkategoria}', 'PagesController@showWordSets')->middleware('removeWordSetData'); // podkategoria
Route::get('/category/{kategoria}/{podkategoria}/{zestaw}', 'PagesController@choice')->middleware('removeWordSetData'); //podkategoria
Route::get('/category/{kategoria}/{podkategoria}/create/privateSet', 'ZestawController@createPrivateSet');

Route::get('/category/{kategoria}/{podkategoria}/{zestaw}/learning/{lang1}/{lang2}/{alg}','ZestawController@learning');
Route::get('/category/{kategoria}/{podkategoria}/{zestaw}/testing/{lang1}/{lang2}/{alg}','ZestawController@testing');
Route::get('/category/{kategoria}/{podkategoria}/{zestaw}/{lang1}/{lang2}/{alg}/check','ZestawController@checkAndShowResult');

Route::get('/wordSet/create', 'ZestawController@create'); // kategoria
Route::get('/loginFailed', 'PagesController@loginError'); //login
Route::get('/roleError', 'PagesController@roleError'); //login
Route::post('/login', 'KontoController@login'); //login
Route::post('/register', 'KontoController@register'); //podkategoria

Route::get('/adminPanel','PagesController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/konta','KontoController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/kategorie','KategoriaController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/podkategorie','PodkategoriaController@adminPanel')->middleware('adminRole');

Route::get('/adminPanel/zestawy','ZestawController@adminPanel')->middleware('adminRole');

Route::get('/adminPanel/jezyki','JezykController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/wyniki','WynikController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/role','RolaController@adminPanel')->middleware('adminRole');
Route::get('/adminPanel/uprawnienia','UprawnieniaController@adminPanel')->middleware('adminRole');

Route::post('/adminPanel/konta','KontoController@create')->middleware('adminRole');


Route::get('/result','ZestawController@showResult')->name('result')->middleware('checkResultInSession');

Route::get('/adminPanel/konta/delete/{id}','KontoController@destroy')->middleware('adminRole');
Route::get('/adminPanel/kategorie/delete/{id}','KategoriaController@destroy')->middleware('adminRole');
Route::get('/adminPanel/podkategorie/delete/{id}','PodkategoriaController@destroy')->middleware('adminRole');

Route::get('/adminPanel/jezyki/delete/{id}','JezykController@destroy')->middleware('adminRole');
Route::get('/adminPanel/wyniki/delete/{id}','WynikController@destroy')->middleware('adminRole');
Route::get('/adminPanel/role/delete/{id}','RolaController@destroy')->middleware('adminRole');
Route::get('/adminPanel/uprawnienia/delete/{id}','UprawnieniaController@destroy')->middleware('adminRole');

Route::get('/adminPanel/konta/edit/{id}','KontoController@edit')->middleware('adminRole');
Route::get('/adminPanel/kategorie/edit/{id}','KategoriaController@edit')->middleware('adminRole');
Route::get('/adminPanel/podkategorie/edit/{id}','PodkategoriaController@edit')->middleware('adminRole');
Route::get('/adminPanel/jezyki/edit/{id}','JezykController@edit')->middleware('adminRole');
Route::get('/adminPanel/wyniki/edit/{id}','WynikController@edit')->middleware('adminRole');
Route::get('/adminPanel/role/edit/{id}','RolaController@edit')->middleware('adminRole');
Route::get('/adminPanel/uprawnienia/edit/{id}','UprawnieniaController@edit')->middleware('adminRole');




Route::get('/logout', 'KontoController@logout');

Route::name('home')->get('/')->uses('PagesController@main');


Route::name('learning')->post('/category/{kategoria}/{podkategoria}/{zestaw}/learning/{lang1}/{lang2}/{alg}')
    ->uses('ZestawController@learning');
Route::name('testing')->post('/category/{kategoria}/{podkategoria}/{zestaw}/testing/{lang1}/{lang2}/{alg}')
    ->uses('ZestawController@testing');

Route::get('myform',array('as'=>'myform','uses'=>'ZestawController@myform'));
Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'ZestawController@myformAjax'));




Route::name('createKonto')->post('/adminPanel/konta')->uses('KontoController@create')->middleware('adminRole');
Route::name('createKategoria')->post('/adminPanel/kategorie')->uses('KategoriaController@create')->middleware('adminRole');
Route::name('createPodkategoria')->post('/adminPanel/podkategorie')->uses('PodkategoriaController@create')->middleware('adminRole');

Route::name('createJezyk')->post('/adminPanel/jezyki')->uses('JezykController@create')->middleware('adminRole');
Route::name('createWynik')->post('/adminPanel/wyniki')->uses('WynikController@create')->middleware('adminRole');
Route::name('createRola')->post('/adminPanel/role')->uses('RolaController@create')->middleware('adminRole');
Route::name('createUprawnienie')->post('/adminPanel/uprawnienia')->uses('UprawnieniaController@create')->middleware('adminRole');

Route::post('/profile', 'KontoController@changeData'); // kategoria
Route::post('/profile/changeData')->uses('KontoController@changeData');
Route::post('/profile/changePassword')->uses('KontoController@changePassword');

Route::get('/crud/category/{kategoria}/delete/{id}','ZestawController@destroy');
Route::get('/crud/category/{kategoria}/edit/{id}','ZestawController@edit');

Route::post('/crud/category/{kategoria}/makeEdit/{id}','ZestawController@makeEdit');
Route::post('/adminPanel/konta/edit/{id}/makeEdit','KontoController@makeEdit');
Route::post('/adminPanel/kategorie/edit/{id}/makeEdit','KategoriaController@makeEdit');
Route::post('/adminPanel/podkategorie/edit/{id}/makeEdit','PodkategoriaController@makeEdit');

Route::post('/adminPanel/konta/edit/{id}/pass','KontoController@changeSomeonesPassword');

Route::name('createZestaw')->post('/category/{kategoria}/{podkategoria}')->uses('ZestawController@create');
Route::get("addmore","ZestawController@addMore");
Route::post("addmore","ZestawController@addMorePost");