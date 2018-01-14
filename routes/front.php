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

Route::get('/', 'PostsController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::feeds();

Route::get('/tag/{tagSlug}', 'TagsController@show');

Route::get('{postSlug}', 'PostsController@show');
