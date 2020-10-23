<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'role'], function() {

    Route::get('/upload-file',        'HomeController@index')->name('get-upload');
    Route::get('/upload',             'UsersController@file')->name('file');
    Route::get('/my-files/{id}-list', 'UsersController@showFiles')->name('show-files');

    Route::post('/upload',               'UsersController@chooseFile')->name('choose-file');
    
    Route::delete('/my-files/{id}-list', 'UsersController@deleteFile')->name('delete');
});

Route::get('/{id}{code}', 'UsersController@generateLink')->name('link');
Route::get('/download/{id}',        'UsersController@downloadFile')->name('download');


