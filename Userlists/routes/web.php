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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('new', 'StudentController@new_index'); //入力
Route::patch('new','StudentController@new_confirm');//確認
Route::post('new', 'StudentController@new_finish'); //完了

//編集
Route::get('edit/{id}/', 'StudentController@edit_index');//編集
Route::patch('edit/{id}/', 'StudentController@edit_confirm');//確認
Route::post('edit/{id}/', 'StudentController@edit_finish');//完了
//削除
Route::post('delete/{id}','StudentController@us_delete');

Route::get('/', 'StudentController@getIndex'); //一覧   
