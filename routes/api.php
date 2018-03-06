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

Route::group(['prefix' => "article"],function(){

	Route::any('add',"ArticleController@add");

	Route::any('remove', "ArticleController@removeArticle");

	Route::any('change',"ArticleController@changeArticle");

});

Route::group(['prefix' => "cat"],function(){

	Route::any('add',"CatController@add");

	Route::any('remove',"CatController@remove");
});
