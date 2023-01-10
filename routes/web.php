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

Route::get('/','ContactController@index')->name('index');
Route::post('/contact/store', 'ContactController@store')->name('contact.store');
Route::post('/contact/{contact}/update', 'ContactController@update')->name('contact.update');
Route::delete('/contact/{contact}/delete', 'ContactController@destroy')->name('destroy');

