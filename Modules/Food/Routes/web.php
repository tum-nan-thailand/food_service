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

Route::prefix('food')->group(function () {
    Route::middleware(['CheckAuth'])->group(function () {
        Route::get('/', 'MainController@list');
        Route::get('/view', 'MainController@view');
        Route::get('/print_food', 'MainController@print_food');
        Route::post('/getTable_foods', 'MainController@getTable');

        /*************Selectted*****************/
        Route::get('/Selected_group_food', 'MainController@Selected_group_food');
        Route::get('/Selected_material_group', 'MainController@Selected_material_group');
        Route::get('/get_auto_form_detail_material', 'MainController@get_auto_form_detail_material');
        /***********************************/





        Route::post('/add_form_detail', 'ManageController@add_form_detail');

                // check Duplicate
                Route::get('/CheckDuplicate_form_detail_tmp', 'ManageController@CheckDuplicate_form_detail_tmp');//
                Route::get('/CheckDuplicate_form_detail', 'ManageController@CheckDuplicate_form_detail');//

        /*************TMP******************* */
        //เพิ่มและแก้ไขรายรายการอาหาร หน้า Add Food
        Route::get('/get_table_form_tmp', 'MainController@get_table_form_tmp');
        Route::get('/Form_Add_list_tmp_detail', 'MainController@Form_Add_list_tmp_detail');
        Route::get('/Form_Edit_list_tmp_detail', 'MainController@Form_Edit_list_tmp_detail');
        Route::post('/add_form_detail_tmp', 'ManageController@add_form_detail_tmp');

        //เพิ่มและแก้ไขรายรายการอาหาร หน้า Edit Food
        Route::get('/Form_Add_list_tmp_detail_Edit', 'MainController@Form_Add_list_tmp_detail_Edit');
        Route::get('/Form_Edit_list_tmp_detail_pageEdit', 'MainController@Form_Edit_list_tmp_detail_pageEdit');
        Route::post('/add_form_detail_tmp_pageEdit', 'ManageController@add_form_detail_tmp_pageEdit');
        Route::get('/get_table_Edit_food', 'MainController@get_table_Edit_food');

        /******************Manage Food*********** */
        Route::get('/Form', 'ManageController@Form');
        Route::get('/form_update_food', 'ManageController@form_update_food');
        Route::post('/update_form_tmp_form_detail_tmp', 'ManageController@update_form_tmp_form_detail_tmp');
        Route::post('/update_form_tmp_form_detail_tmp_EditPage', 'ManageController@update_form_tmp_form_detail_tmp_EditPage');
        Route::post('/delete_form_detail_tmp', 'ManageController@delete_form_detail_tmp');
        Route::post('/delete_form_detail', 'ManageController@delete_form_detail');
        Route::post('/listfood_save', 'ManageController@listfood_save');
        Route::post('/listfood_edit', 'ManageController@listfood_edit');
        Route::post('/delete_foods', 'ManageController@delete_foods');


    });
});
