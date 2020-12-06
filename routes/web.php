<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/owner/dashboard', 'Admin_Controller\MainIndexController@Ownerindex')->name('owner.dashboard');

