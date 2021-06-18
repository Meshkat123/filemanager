<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Http\Controllers';
Route::namespace($namespace)->name('admin:')->middleware(['auth:web'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('index');
    /************************* User ******************************/
	Route::get('/user','UserController@Index')->name('user');
	Route::post('/saveUser','UserController@saveUser')->name('saveUser');
	Route::post('/updateUser','UserController@updateUser')->name('updateUser');
	Route::get('/user/delete/{id}','UserController@Delete')->name('delete_user');
	Route::get('/approveUser/{id}/{id2}','UserController@approveUser')->name('approveUser');

    /************************* Site Settings ******************************/
	Route::get('/site/setup','SettingController@Index')->name('setup_site');
	Route::post('/updateSettingForums','SettingController@updateSettingForums')->name('updateSettingForums');
	
	/************************* File Management ******************************/
	Route::get('/files','FileManageController@Index')->name('files');
});

Auth::routes();
