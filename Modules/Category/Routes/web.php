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

Route::prefix('category')->group(function() {
    Route::middleware(['CheckAuth'])->group(function () {
/*******กลุ่มวัตถุดิบ*********/
      Route::get('/material_group', 'MaterialController@material_group');
      Route::post('/getTable_material_group', 'MaterialController@getTable');
      Route::get('/form_material_group', 'MaterialController@form_material_group');
      Route::post('/material_group_save', 'MaterialController@material_group_save');
      Route::post('/material_group_update', 'MaterialController@material_group_update');
      Route::get('/view_material_group', 'MaterialController@view_material_group');
      Route::post('/delete_material_group', 'MaterialController@delete_material_group');
      Route::get('/check_groupid_duplicate', 'MaterialController@check_groupid_duplicate');
/************* Import & Export กลุ่มวัตถุดิบ********************/
Route::get('/example_import_materialgroup', 'MaterialController@example_import_materialgroup');//ถ้าออนไลน์
Route::get('/import_material_group', 'MaterialController@import_material_group');
Route::post('/upload_material_group', 'MaterialController@upload_material_group');
Route::get('/upload_material_group_view', 'MaterialController@upload_material_group_view');
Route::post('/material_group_checkImport', 'MaterialController@material_group_checkImport');
Route::get('/export_excel_material_group', 'MaterialController@export_excel_material_group');
/*************************/



/*******กลุ่มอาหาร*********/
        Route::get('/foods_group', 'FoodsController@foods_group');
        Route::post('/getTable_foods_group', 'FoodsController@getTable');
        Route::get('/form_foods_group', 'FoodsController@form_foods_group');
        Route::post('/foods_group_save', 'FoodsController@foods_group_save');
        Route::post('/foods_group_update', 'FoodsController@foods_group_update');
        Route::get('/check_groupid_duplicate_foods', 'FoodsController@check_groupid_duplicate');
        Route::post('/delete_foods_group', 'FoodsController@delete_foods_group');

        /************* Import & Export กลุ่มอาหาร********************/
Route::get('/export_excel_foods_group', 'FoodsController@export_excel_foods_group');
Route::get('/import_foods_group', 'FoodsController@import_foods_group');
Route::post('/upload_foods_group', 'FoodsController@upload_foods_group');
Route::get('/upload_foods_view', 'FoodsController@upload_foods_view');
Route::post('/foods_group_checkImport', 'FoodsController@foods_group_checkImport');
/*************************/
    });
});
