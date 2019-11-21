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

Route::prefix('Calculate')->group(function() {
    Route::middleware(['CheckAuth'])->group(function () {
        Route::get('/', 'CalculateController@index');
        Route::get('/get_list_group_food', 'CalculateController@get_list_group_food');
        Route::post('/print_order', 'CalculateController@print_order');

        // Event Get Table
        Route::get('/get_datas_groupfood', 'CalculateController@get_datas_groupfood');
        Route::get('/get_datas_food_price', 'CalculateController@get_datas_food_price');

    });
});
