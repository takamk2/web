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

use Illuminate\Support\Facades\Route;

Route::get('/posts', 'PostsController@index');
//Route::get('/posts/{id}', 'PostsController@show');

Route::get('/healths', 'HealthsController@index');
Route::get('/todos', 'TodosController@index');
