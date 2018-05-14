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
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'UserController@index')->name('home');

    Route::prefix('contato')->group(function () {
        Route::get('/{id?}', 'ContatoController@form')->name('contato');
        Route::post('/add', 'ContatoController@store')->name('add.contato');
        Route::get('/delete/{id}', 'ContatoController@delete')->name('delete.contato');
    });
    Route::post('search', 'ContatoController@search')->name('search');

    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('profile/edit', 'UserController@edit')->name('edit.user');

    Route::get('password', 'UserController@password')->name('password');
    Route::post('password/edit', 'UserController@editPassword')->name('password.edit');

    Route::get('delete', 'UserController@delete')->name('delete.user');
    
});



