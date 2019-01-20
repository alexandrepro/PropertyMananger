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
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [
	'as'=>'property.home', 
	'uses'=>'Property\PropertyController@index'
]);

Route::get('/property/search', [
	'as'=>'property.search', 
	'uses'=>'Property\PropertyController@search'
]);

Route::get('/property/create', [
	'as'=>'property.create', 
	'uses'=>'Property\PropertyController@create'
]);

Route::get('/property/edit/{id}', [
	'as'=>'property.edit', 
	'uses'=>'Property\PropertyController@edit'
]);

Route::post('/property/update/{id}', [
	'as'=>'property.update', 
	'uses'=>'Property\PropertyController@update'
]);

Route::post('/property/store', [
	'as'=>'property.store', 
	'uses'=>'Property\PropertyController@store'
]);

Route::get('/property/delete/{id}', [
	'as'=>'property.delete', 
	'uses'=>'Property\PropertyController@delete'
]);