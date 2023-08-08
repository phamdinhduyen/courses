<?php 
 use Illuminate\Support\Facades\Route;

 Route::group(['namespace' => 'Modules\categories\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'categoriesController@index')->name('index');
            Route::get('/data', 'categoriesController@data')->name('data');
            Route::get('/create', 'categoriesController@create')->name('create');
            Route::post('/create', 'categoriesController@store')->name('store');
            Route::get('/edit{category}', 'categoriesController@edit')->name('edit');
            Route::put('/edit{category}', 'categoriesController@update')->name('edit');
            Route::delete('/delete{category}', 'categoriesController@delete')->name('delete');
        });
    });
 });