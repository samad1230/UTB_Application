<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//php artisan migrate:fresh --seed
Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    //$run = Artisan::call('clear-compiled');
    return 'FINISHED';
});

Route::get('/', function () {
    return redirect()->route('login');
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

//user login and dashboard
Route::get('/User/Dashboard', 'Admin_Controller\MainLoginController@Userdashboard')->name('user.dashboard');
Route::get('/User/Department', 'Admin_Controller\MainLoginController@UserDepartment')->name('service.paneluser');
/// dash user


// department controller================================================
Route::get('/Purchase-Department', 'Admin_Controller\MainLoginController@purchaseDepartment')->name('purchase.department-access');
Route::get('/Hradmin-Department', 'Admin_Controller\MainLoginController@HradminDepartment')->name('hradmin.department-access');
Route::get('/Accounts-Department', 'Admin_Controller\MainLoginController@AccountsDepartment')->name('accounts.department-access');
Route::get('/Commercial-Department', 'Admin_Controller\MainLoginController@CommercialDepartment')->name('commercial.department-access');
Route::get('/Store-Department', 'Admin_Controller\MainLoginController@StoreDepartment')->name('store.department-access');
Route::get('/Sales-Department', 'Admin_Controller\MainLoginController@SalesDepartment')->name('sales.department-access');
//====================================


// main index controller=================================
Route::get('/Categories/Add','Admin_Controller\MainIndexController@CategoryIndex')->name('add.categories');
Route::get('/Subcategory/Add','Admin_Controller\MainIndexController@SubcategoryIndex')->name('add.subcategory');
Route::get('/Procategory/Add','Admin_Controller\MainIndexController@ProcategoryIndex')->name('add.procategory');
Route::get('/Brand/Add','Admin_Controller\MainIndexController@BrandIndex')->name('add.brand');
Route::get('/Feature/Product','Admin_Controller\MainIndexController@FeatureProduct')->name('add.featureproducts');
Route::get('/Product/Details','Admin_Controller\MainIndexController@ProductDetails')->name('Product.details');
Route::get('/Product/Edit/{slag}','Admin_Controller\MainIndexController@ProductEdit')->name('product.edit');

// main index controller==================================

//=========== Categories Controller===================
Route::resource('/categories', 'Product\CategoryController');
Route::resource('/subcategory', 'Product\SubCategoryController');
Route::resource('/procategory', 'Product\ProCategoryController');
Route::resource('/brand', 'Product\BrandController');
Route::resource('/Product', 'Product\ProductController');
Route::resource('/Purchase', 'Product\PurchaseController');
Route::resource('/Supplier', 'Supplier_controller\SupplierController');
//==================Categories Controller===========================


// ajax controller ========================
Route::get('/categores_edit/{id}','Admin_Controller\AjaxController@CategoresEditdata');
Route::get('/subcategory_edit/{id}','Admin_Controller\AjaxController@SubCategoresEditdata');
Route::get('/procategory_edit/{id}','Admin_Controller\AjaxController@ProCategoresEditdata');
Route::get('/branddata_edit/{id}','Admin_Controller\AjaxController@BrandEditdata');
Route::get('/product_feturedata/{slag}','Admin_Controller\AjaxController@ProductFetureData');
Route::get('/product_categoriesdata/{slag}','Admin_Controller\AjaxController@ProductCategoryesData');
Route::post('/product_image_remove','Admin_Controller\AjaxController@ProductimageRemove');
Route::post('/feature_id_remove','Admin_Controller\AjaxController@Feature_id_Remove');
Route::post('/feature_group_remove','Admin_Controller\AjaxController@FeatureGroupRemove');
Route::get('/purchesh_suplier_data/{id}','Admin_Controller\AjaxController@AccountsPurchaseSupplier');
Route::get('/purchesh_product_data/{id}','Admin_Controller\AjaxController@PurchaseProductData');

// ajax controller===================
