<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//php artisan migrate:fresh --seed
//php artisan serve --port=8080
//php artisan make:seeder UserSeeder

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
Route::get('/Product/Purchase-Stock','Admin_Controller\MainIndexController@DetailsProductPurchaseStock')->name('ProductPurchase.Stock');
Route::get('/Add/Recognition','Admin_Controller\MainIndexController@AddRecognition')->name('add.recognition');
Route::get('/Recognition/Details','Admin_Controller\MainIndexController@DetailsRecognition')->name('recognition.details');
Route::get('/Recognition/Status','Admin_Controller\MainIndexController@RecognitionStatus')->name('recognition.status');
Route::get('/Recognition/Approved','Admin_Controller\MainIndexController@ApprovedRecognition')->name('recognition.approve');
Route::get('/Recognition/Purchase/Approved','Admin_Controller\MainIndexController@ApprovedPurchaseRecognition')->name('recognition_purchase.approve');
Route::get('/Supplier/Accounts','Admin_Controller\MainIndexController@AccountsSupplier')->name('supplier.accounts');
Route::get('/Bank/Index','Admin_Controller\MainIndexController@BankIndex')->name('bank.index');
Route::get('/Product/Details/Update','Admin_Controller\MainIndexController@ProductDetailsUpdate')->name('product_details_update');
Route::get('/Sell/Product/Edit/{slag}','Admin_Controller\MainIndexController@SellProductEditPlacement')->name('sell_product.edit');

// main index controller==================================

//=========== Categories Controller===================
Route::resource('/categories', 'Product\CategoryController');
Route::resource('/subcategory', 'Product\SubCategoryController');
Route::resource('/procategory', 'Product\ProCategoryController');
Route::resource('/brand', 'Product\BrandController');
Route::resource('/Product', 'Product\ProductController');
Route::resource('/Supplier', 'Supplier_controller\SupplierController');
Route::resource('/Bank', 'Accounts_Controller\BankController');
Route::post('/Bank_deposit/{id}', 'Accounts_Controller\BankController@BankDeposit');
Route::resource('/CashBlanch', 'Accounts_Controller\CashBlanchController');
Route::resource('/Warehouse', 'Store_department\WarehouseController');
Route::resource('/Sells', 'SellsDepartment\SellUpdateController');

Route::post('/Warehouse/Product','Store_department\WarehouseController@update')->name("warehousedata.update");
//==================Categories Controller===========================


Route::get('/Supplier/Payment_view/{id}', 'Supplier_controller\SupplierController@SupplierPayment')->name('supplier_payment_view');

Route::post('/Supplier/Payment/update/{id}', 'Supplier_controller\SupplierController@SupplierPaymentUpdate')->name('supplier_payment_update');


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
Route::get('/Bank_accountdata/{id}','Admin_Controller\AjaxController@BankaccountData');
Route::get('/account_blanch','Admin_Controller\AjaxController@AccountBlanch');
Route::get('/Bank_accountlist','Admin_Controller\AjaxController@BankAccountsList');
Route::get('/Bank_account_blanch/{id}','Admin_Controller\AjaxController@BankAccountBlanch');
Route::get('/storeproduct_id/{id}','Admin_Controller\AjaxController@StoreproductData');


// ajax controller===================

//warehouse controller





// search and view details ============================
Route::get('/productsearching_stoke','Admin_Controller\SearchViewDetailsController@Allproduct_stokedata')->name('product.purcheshdata');
Route::get('/Purchase/Detail/{id}','Admin_Controller\SearchViewDetailsController@DetailsPurchaseView')->name('purchesedetail.view');

// search and view details ============================



// Recognition section
Route::resource('/Recognition', 'Store_department\RecognitionController');
Route::get('/Recognition/Delete/{id}', 'Store_department\RecognitionController@destroy')->name('Recognition.delete');
Route::get('/Recognition/approve_details/{id}', 'Store_department\RecognitionController@Recognitionapprove_details')->name('Recognition.approve_details');
Route::get('/recognition_edit/{id}', 'Admin_Controller\AjaxController@RecognitionItemData');
Route::post('/Recognition_price/update', 'Store_department\RecognitionController@RecognitionPriceUpdate')->name('recognition_price.update');
Route::get('/Purchase/Approve/Details/{id}', 'Store_department\RecognitionController@ApprovePurchaseDetails')->name('purchase.approve_details');
Route::post('/purchase_accounts_cost_analysis', 'Store_department\RecognitionController@AccountsCostAnalysis')->name('purchase_accounts_cost_analysis');

Route::get('/purchaseapprove_data/{id}', 'Admin_Controller\AjaxController@Purchaseapprove_dataItemData');


// Recognition section


