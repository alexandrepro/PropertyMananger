<?php

use Illuminate\Http\Request;
use PropertyManager\Utilities\GoogleMaps;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('properties','Property\PropertyController@getProperties');
Route::get('properties/{id}','Property\PropertyController@getPropertiesById');
Route::post('properties','Property\PropertyController@postProperties');
//$coordinates = GoogleMaps::geocodeAddress($request->get('address'));