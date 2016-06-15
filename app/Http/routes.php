<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 123;
});
Route::get('/sv',function(){
	return 123;
});
Route::get('index','Home\IndexController@index');
Route::get('tag_search','Home\IndexController@tag_search');
Route::get('get_content','Home\IndexController@get_content');
Route::get('get_all_count','Home\IndexController@get_all_count');
Route::get('get_index_content','Home\IndexController@get_index_content');
Route::get('ddd','BaseController@demo');
Route::get('base','BaseController@demo');
Route::get('demo','DemoController@demo');
Route::get('ex','Home_Controller@ex');
Route::get('get_tag_all_count','Home\IndexController@get_tag_all_count');
Route::get('admin_get_all',"Home\IndexController@admin_get_all");

/**** admin *****/

Route::get("admin_get_content_detai","Admin\IndexController@admin_get_content_detai");
Route::POST("admin_content_edite","Admin\IndexController@admin_content_edite");
Route::POST("admin_content_add","Admin\IndexController@admin_content_add");
Route::POST("admin_content_del","Admin\IndexController@admin_content_del");
Route::POST("admin/demo","Admin\IndexController@demo");

/*** Hillwater ***/
Route::POST("hillwater_add","Hillwater\IndexController@hillwater_content_add");
Route::get("hillwater_get","Hillwater\IndexController@hillwater_get");
Route::POST('hillwater_editor',"Hillwater\IndexController@hillwater_editor");
Route::get('hillwater_all_get',"Hillwater\IndexController@hillwater_all_get");
Route::POST("hillwater_del","Hillwater\IndexController@hillwater_del");
