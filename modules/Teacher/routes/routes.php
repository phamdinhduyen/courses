<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\Teacher\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get('/', 'TeacherController@index')->name('index');
            Route::get('/data', 'TeacherController@data')->name('data');
            Route::get('/create', 'TeacherController@create')->name('create');
            Route::post('/create', 'TeacherController@store')->name('store');
            Route::get('/edit{teacher}', 'TeacherController@edit')->name('edit');
            Route::put('/edit{teacher}', 'TeacherController@update')->name('edit');
            Route::delete('/delete{teacher}', 'TeacherController@delete')->name('delete');
        });
    });
 });