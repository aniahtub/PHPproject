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
    return view('welcome');
})->name('welcome');
Route::get('/todos','TodosController@index')->name('index');
Route::get('/todos/{todo}', 'TodosController@show')->name('show');
Route::get('/new-todo', 'TodosController@create')->name('create');
Route::post('store-todo', 'TodosController@store')->name('store');
Route::get('/todo/{todo}/edit', 'TodosController@edit')->name('edit');
Route::post('/todo/{todo}/update', 'TodosController@update')->name('update');
Route::get('/todo/{todo}/delete', 'TodosController@destroy')->name('destroy');
Route::get('/todo/{todo}/complete', 'TodosController@complete')->name('complete');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
