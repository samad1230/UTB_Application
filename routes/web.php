<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Owner panel
Route::get('/owner/dashboard', 'OwnerController\AdminManagementController@Ownerindex')->name('owner.dashboard');
Route::get('/Service/Panel/owner', 'OwnerController\AdminManagementController@Servicepanel')->name('service.panelall');
Route::post('/Service/Registration', 'OwnerController\AdminManagementController@Serviceregistration')->name('service.registration');
Route::get('/Admin/User/Panel', 'OwnerController\AdminManagementController@AdminuserPanel')->name('useradmin.panelall');
Route::post('/Admin/Registration', 'OwnerController\AdminManagementController@adminregistration')->name('admin.registration');
Route::post('/Owner/Profile/Update', 'OwnerController\AdminManagementController@OwnerprofileUpdate')->name('woner_profile.update');
//=====================================================



//admin panel and user management Controller
Route::get('/Admin/Dashboard', 'Admin_Controller\PanelManagementController@Admindashboard')->name('admin.dashboard');
Route::get('/Service/Panel/admin', 'Admin_Controller\PanelManagementController@Servicepaneladmin')->name('service.paneladmin');
Route::get('/Admin/User/Details', 'Admin_Controller\PanelManagementController@Userdetails')->name('user.details');
Route::post('/User/Registration', 'Admin_Controller\PanelManagementController@Userregistration')->name('User.registration');

Route::post('/Admin/Profile/Update', 'Admin_Controller\PanelManagementController@AdminprofileUpdate')->name('Admin_profile.update');

Route::get('/Admin/Customer/Details', 'Admin_Controller\PanelManagementController@Customerdetails')->name('customer.details');

//==================================

Route::get('/User/Dashboard', 'Admin_Controller\MainLoginController@Userdashboard')->name('user.dashboard');

Route::get('/purchase-department', 'Admin_Controller\MainLoginController@purchaseDepartment')->name('purchase.department-access');




//=========== Categories Controller===================

//==============================================================



