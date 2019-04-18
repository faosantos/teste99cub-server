<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
  Route::get('apiTokenCheck', 'Api\UserController@apiTokenCheck');
  Route::patch('setLocation', 'Api\UserController@setLocation');
  Route::patch('setFavorite', 'Api\UserController@setFavorite');
  Route::post('uploadImage', 'Api\UserController@uploadImage');
  Route::delete('deleteImage', 'Api\UserController@deleteImage');


  Route::get('localFeed', 'Api\FeedController@getLocal');
  Route::get('searchFeed', 'Api\FeedController@getSearch');
  Route::get('favoritesFeed', 'Api\FeedController@getFavorites');




});

