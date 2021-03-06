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

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::redirect('/', '/admin/posts');
    Route::resource('posts', 'PostsController');

    Route::resource('tags', 'TagsController');
});
