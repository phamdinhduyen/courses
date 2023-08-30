<?php 
use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\Admin\LoginController;



;
Route::group(['namespace' => 'Modules\Auth\src\Http\Controllers\Admin', 'middleware' => 'web'], function () {
    Route::get('/login', "LoginController@showLoginForm")->name('login'); 
    Route::post('/login', "LoginController@login")->name('login'); 
    Route::post('/logout', "LoginController@logout")->name('logout'); 
});