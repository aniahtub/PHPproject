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
    return view('welcome')->with('data',['name'=>'imran','age'=>21,'status'=>'married']);
});
Route::get('/todos', 'TodosController@index');
Route::get('todos/{todo}', 'TodosController@show');
Route::get('/new-todo', 'TodosController@create');
Route::post('store-todo', 'TodosController@store');
Route::get('/todo/{todo}/edit', 'TodosController@edit');
Route::post('/todo/{todo}/update', 'TodosController@update');
Route::get('/todo/{todo}/delete', 'TodosController@destroy');