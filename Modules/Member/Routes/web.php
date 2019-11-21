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

Route::prefix('profile')->group(function() {
    Route::get('/', 'MemberController@profile');
     Route::get('/change_pass', 'MemberController@show_change_password');
     Route::post('/change_pass', 'MemberController@change_password_save');
     Route::post('/update', 'MemberController@update');

});
