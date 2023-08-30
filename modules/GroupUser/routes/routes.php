<?php 
 use Illuminate\Support\Facades\Route;

 Route::group(['namespace' => 'Modules\groupUser\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('group_user')->name('group_user.')->group(function () {
            Route::get('/', 'GroupUserController@index')->name('index');
            Route::get('/data', 'GroupUserController@data')->name('data');
            Route::get('/create', 'GroupUserController@create')->name('create');
            Route::post('/create', 'GroupUserController@store')->name('store');
            Route::get('/edit{group_user}', 'GroupUserController@edit')->name('edit');
            Route::put('/edit{group_user}', 'GroupUserController@update')->name('edit');
            Route::delete('/delete{group_user}', 'GroupUserController@delete')->name('delete');
        });
    });
 });