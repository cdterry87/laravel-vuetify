<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes();
Route::get('/api/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/home', 'HomeController@index')->name('home');
