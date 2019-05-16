<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/posts', 'Api\PostsController@index');
Route::post('/posts/create', 'Api\PostsController@store');
Route::get('/posts/{id}/delete', 'Api\PostsController@destroy');
Route::get('/posts/{id}', 'Api\PostsController@show');

Route::get('/healths', 'Api\HealthsController@index');
Route::post('/healths/create', 'Api\HealthsController@store');

Route::get('/todos', 'Api\TodosController@index');
Route::post('/todos/create', 'Api\TodosController@store');
Route::get('/todos/{id}/complete', 'Api\TodosController@complete');

Route::get('/locations', 'Api\LocationsController@index');
Route::post('/locations/create', 'Api\LocationsController@store');

Route::group(['middleware' => 'guest:api'], function(){
    Route::post('/login', 'ApiController@login');
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/me', 'ApiController@me');
});
