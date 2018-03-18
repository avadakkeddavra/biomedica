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
Route::get('/','DashboardController@index');
Route::get('/pay/accept','PayController@accept');
Route::get('/pay/create/{analysis}','PayController@create');
Route::post('/api/pay','PayController@accept');


Route::get('/home',function(){
    return redirect('/admin');
});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin','AdminController@index')->name('admin');
    Route::get('/admin/category','CategoryController@show')->name('admin.category');
    Route::get('/admin/category/create','CategoryController@create')->name('create.category');
    Route::post('/admin/category/create','CategoryController@create')->name('create.category.post');
    Route::post('/admin/category/change','CategoryController@changeName')->name('change.category.post');
    Route::post('/admin/category/delete','CategoryController@delete')->name('delete.category.post');

    Route::get('/admin/analysis/','AnalysisController@show')->name('admin.analysis');
    Route::get('/admin/analysis/create','AnalysisController@create')->name('create.analysis');
    Route::post('/admin/analysis/create','AnalysisController@create')->name('create.analysis.post');

    Route::get('/admin/faqs',"FaqController@index")->name('admin.faqs');
    Route::get('/admin/faqs/create',"FaqController@create")->name('create.faqs');
    Route::post('/admin/faqs/create',"FaqController@create")->name('create.faqs.post');
    Route::post('/admin/faqs/delete',"FaqController@delete")->name('delete.faqs.post');
});
