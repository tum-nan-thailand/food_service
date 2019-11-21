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

Route::prefix('auth')->group(function() {
    Route::get('/login', 'AuthController@index');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/login', 'AuthController@login');
});
Route::prefix('auth_user')->group(function() {
    Route::middleware(['CheckAuth'])->group(function () {
        Route::get('/', 'mainController@showform_users');
        Route::post('/getdata', 'mainController@get_data');
        Route::post('/change_status', 'mainController@change_status');
        Route::get('/form', 'mainController@form');
        Route::get('/form/{id}', 'mainController@form');
        Route::get('/view', 'mainController@view');
        Route::post('/save', 'mainController@save');
        Route::post('/update', 'mainController@update');
        Route::post('/delete', 'mainController@delete');
    });
});
