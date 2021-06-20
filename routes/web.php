<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Http\Controllers';
Route::namespace($namespace)->name('admin:')->middleware(['auth:web'])->group(function () {
    Route::get('/', 'DashboardController@Index')->name('index');
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
	Route::get('/file_details/{id}','FileManageController@Details')->name('files.details');
	Route::post('/saveFile','FileManageController@saveFile')->name('saveFile');
	Route::post('/updateFile','FileManageController@updateFile')->name('updateFile');
	Route::post('/saveDoc','FileManageController@saveDoc')->name('saveDoc');
	Route::get('/file/edit/{id}','FileManageController@FileEdit')->name('FileEdit');
	Route::get('/file/delete/{id}','FileManageController@FileDelete')->name('FileDelete');
	Route::get('/file/doc/delete/{id}','FileManageController@DocDelete')->name('DocDelete');
	Route::get('/file/document/search','FileManageController@DocSearch')->name('DocSearch');
	Route::get('/file/document/filter','FileManageController@DocFilter')->name('DocFilter');

	Route::get('/file_setup','FileManageController@Setup')->name('files.setup');
	Route::get('/file_setup/edit/{id}','FileManageController@SetupEdit')->name('SetupEdit');
	Route::get('/file_setup/delete/{id}','FileManageController@SetupDelete')->name('SetupDelete');
	Route::post('/saveType','FileManageController@saveFileType')->name('saveFileType');
	Route::post('/updateType','FileManageController@updateFileType')->name('updateFileType');
});

Auth::routes();
