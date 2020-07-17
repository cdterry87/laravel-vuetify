<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// Website welcome page
Route::get('/', function () {
    return view('welcome');
});

// Pre-defined auth routes and logout function
Auth::routes();
Route::get('/logout', 'UserController@logout')->name('logout');

// User authenticated home route
Route::get('/home', 'HomeController@index')->name('home');

// User authenticated routes
Route::group(['middleware' => 'auth'], function () {

    // Catch-all route
    Route::get('/{any}', 'HomeController@index')->where('any', '.*');
});
