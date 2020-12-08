<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Owner panel
Route::get('/owner/dashboard', 'OwnerController\AdminManagementController@Ownerindex')->name('owner.dashboard');
Route::post('/Admin/Registration', 'OwnerController\AdminManagementController@adminregistration')->name('admin.registration');
Route::post('/Owner/Profile/Update', 'OwnerController\AdminManagementController@OwnerprofileUpdate')->name('woner_profile.update');
//=====================================================

//admin panel
Route::get('/Admin/Dashboard', 'Admin_Controller\MainIndexController@Adminindex')->name('admin.dashboard');
Route::post('/User/Registration', 'Admin_Controller\MainIndexController@Userregistration')->name('User.registration');
Route::post('/Admin/Profile/Update', 'Admin_Controller\MainIndexController@AdminprofileUpdate')->name('Admin_profile.update');
Route::get('/Admin/User/Details', 'Admin_Controller\MainIndexController@Userdetails')->name('user.details');
Route::get('/Admin/Customer/Details', 'Admin_Controller\MainIndexController@Customerdetails')->name('customer.details');
//==================================



