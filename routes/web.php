<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\backend\Add_onsController;
use App\Http\Controllers\backend\AddOnsMaterialSettingController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ChocolateFlavorController;
use App\Http\Controllers\backend\CounterController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\ExpenseHeadController;
use App\Http\Controllers\backend\ExpenseTypeController;
use App\Http\Controllers\backend\factoryController;
use App\Http\Controllers\backend\FlavorController;
use App\Http\Controllers\backend\FundController;
use App\Http\Controllers\backend\KitchenController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OtherIncomeHeadController;
use App\Http\Controllers\backend\OtherIncomeSaveController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\productMaterialSettingsController;
use App\Http\Controllers\backend\PurchaseController;
use App\Http\Controllers\backend\RawMaterialController;
use App\Http\Controllers\backend\supplierController;
use App\Http\Controllers\backend\TableNoController;
use App\Http\Controllers\backend\VatController;
use App\Http\Controllers\backend\WaiterController;
use App\Models\OtherIncomeSave;
use App\Models\Purchase;
use App\Models\Raw_Material;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




    
    Route::get('/admin', [ AdminHomeController::class,'adminHome'])->name('admin.index')->middleware('auth');



// Route for Category
Route::name('admin.')->prefix('admin/category')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [CategoryController::class,'category'])->name('category');
    Route::get('/alldata', [CategoryController::class,'alldata'])->name('category.alldata');
 
    Route::post('/create', [CategoryController::class,'store_category'])->name('category.create');
    Route::put('/{id}', [CategoryController::class,'update_category'])->name('category.update');
    Route::get('/edit/{id}', [CategoryController::class,'edit_data'])->name('category.edit_data');
    
    Route::get('/{id}/change_sts', [CategoryController::class,'category_change_sts'])->name('category.change_sts');
    Route::post('/filter', [CategoryController::class,'category_info_filter'])->name('category_info_filter');


});



// Route for Flavor
Route::name('admin.')->prefix('/admin/flavor')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [FlavorController::class,'flavor'])->name('flavor');
    Route::get('/alldata', [FlavorController::class,'alldata'])->name('flavor.alldata');
    Route::get('/edit/{id}', [FlavorController::class,'edit_data'])->name('flavor.edit_data');

    Route::post('/create', [FlavorController::class,'store_flavor'])->name('flavor.create');
    Route::put('/{id}', [FlavorController::class,'update_flavor'])->name('flavor.update');

    Route::get('/{id}/change_sts', [FlavorController::class,'flavor_change_sts'])->name('flavor.change_sts');
    Route::post('/filter', [FlavorController::class,'flavor_info_filter'])->name('flavor_info_filter');


});

// Route for Chocolate_Flavor
Route::name('admin.')->prefix('admin/chocolate_flavor')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [ChocolateFlavorController::class,'chocolate_flavor'])->name('chocolate_flavor');
    Route::get('/alldata', [ChocolateFlavorController::class,'alldata'])->name('chocolate_flavor.alldata');
    Route::get('/edit/{id}', [ChocolateFlavorController::class,'edit_data'])->name('chocolate_flavor.edit_data');

    Route::post('/create', [ChocolateFlavorController::class,'store_chocolate_flavor'])->name('chocolate_flavor.create');
    Route::put('/{id}', [ChocolateFlavorController::class,'update_chocolate_flavor'])->name('chocolate_flavor.update');

    Route::get('/{id}/change_sts', [ChocolateFlavorController::class,'chocolate_flavor_change_sts'])->name('chocolate_flavor.change_sts');
    Route::post('/filter', [ChocolateFlavorController::class,'chocolate_flavor_info_filter'])->name('chocolate_flavor_info_filter');


});

// Route for Add_ons
Route::name('admin.')->prefix('admin/add_ons')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [Add_onsController::class,'add_ons'])->name('add_ons');
    Route::post('/create', [Add_onsController::class,'store_add_ons'])->name('add_ons.create');
    Route::get('/edit/{id}', [Add_onsController::class,'edit_add_ons'])->name('add_ons.edit');

    Route::put('/{id}', [Add_onsController::class,'update_add_ons'])->name('add_ons.update');

    Route::get('/{id}/change_sts', [Add_onsController::class,'add_ons_change_sts'])->name('add_ons.change_sts');
    Route::post('/filter', [Add_onsController::class,'add_ons_info_filter'])->name('add_ons_info_filter');


});

// Route for raw_material
Route::name('admin.')->prefix('admin/raw_material')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [RawMaterialController::class,'raw_material'])->name('raw_material');
    Route::post('/create', [RawMaterialController::class,'store_raw_material'])->name('raw_material.create');
    Route::get('/edit/{id}', [RawMaterialController::class,'edit_raw_material'])->name('raw_material.edit');

    Route::put('/{id}', [RawMaterialController::class,'update_raw_material'])->name('raw_material.update');

    Route::get('/{id}/change_sts', [RawMaterialController::class,'raw_material_change_sts'])->name('raw_material.change_sts');
    Route::post('/filter', [RawMaterialController::class,'raw_material_info_filter'])->name('raw_material_info_filter');


});

// Route for Counter
Route::name('admin.')->prefix('admin/counter')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [CounterController::class,'counter'])->name('counter');
    Route::get('/alldata', [CounterController::class,'alldata'])->name('counter.alldata');

    Route::get('/edit/{id}', [CounterController::class,'edit_data'])->name('counter.edit_data');

    Route::post('/create', [CounterController::class,'store_counter'])->name('counter.create');
    Route::put('/{id}', [CounterController::class,'update_counter'])->name('counter.update');

    Route::get('/{id}/change_sts', [CounterController::class,'counter_change_sts'])->name('counter.change_sts');
    Route::post('/filter', [CounterController::class,'counter_info_filter'])->name('counter_info_filter');


});

Route::get('pagination/fetch_data', [CounterController::class,'fetch_data']);


// Route for Fund
Route::name('admin.')->prefix('admin/fund')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [FundController::class,'fund'])->name('fund');
    Route::post('/create', [FundController::class,'store_fund'])->name('fund.create');
    Route::get('/edit/{id}', [FundController::class,'edit_fund'])->name('fund.edit_data');

    Route::put('/{id}', [FundController::class,'update_fund'])->name('fund.update');

    Route::get('/{id}/change_sts', [FundController::class,'fund_change_sts'])->name('fund.change_sts');
    Route::post('/filter', [FundController::class,'fund_info_filter'])->name('fund_info_filter');


});


// Route for Expense_Type
Route::name('admin.')->prefix('admin/expense_type')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [ExpenseTypeController::class,'expense_type'])->name('expense_type');
    Route::post('/create', [ExpenseTypeController::class,'store_expense_type'])->name('expense_type.create');
    Route::get('/edit/{id}', [ExpenseTypeController::class,'edit_expense_type'])->name('expense_type.edit');
    Route::put('/{id}', [ExpenseTypeController::class,'update_expense_type'])->name('expense_type.update');

    Route::get('/{id}/change_sts', [ExpenseTypeController::class,'expense_type_change_sts'])->name('expense_type.change_sts');
    Route::post('/filter', [ExpenseTypeController::class,'expense_type_info_filter'])->name('expense_type_info_filter');


});





// Route for Expense Head
Route::name('admin.')->prefix('admin/expense_head')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [ExpenseHeadController::class,'expense_head'])->name('expense_head');
    Route::post('/create', [ExpenseHeadController::class,'store_expense_head'])->name('expense_head.create');
    Route::get('/edit/{id}', [ExpenseHeadController::class,'edit_expense_head'])->name('expense_head.edit');
    Route::put('/{id}', [ExpenseHeadController::class,'update_expense_head'])->name('expense_head.update');

    Route::get('/{id}/change_sts', [ExpenseHeadController::class,'expense_head_change_sts'])->name('expense_head.change_sts');
    Route::post('/filter', [ExpenseHeadController::class,'expense_head_info_filter'])->name('expense_head_info_filter');


});



// Route for Other Income
Route::name('admin.')->prefix('admin/other_income')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [OtherIncomeHeadController::class,'other_income'])->name('other_income');
    Route::post('/create', [OtherIncomeHeadController::class,'store_other_income'])->name('other_income.create');
    Route::get('/edit/{id}', [OtherIncomeHeadController::class,'edit_other_income'])->name('other_income.edit_data');

    Route::put('/{id}', [OtherIncomeHeadController::class,'update_other_income'])->name('other_income.update');

    Route::get('/{id}/change_sts', [OtherIncomeHeadController::class,'other_income_change_sts'])->name('other_income.change_sts');
    Route::post('/filter', [OtherIncomeHeadController::class,'other_income_info_filter'])->name('other_income_info_filter');


});


// Route for Other Vat
Route::name('admin.')->prefix('admin/vat')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [VatController::class,'vat'])->name('vat');
    Route::post('/create', [VatController::class,'store_vat'])->name('vat.create'); 
    Route::get('/edit/{id}', [VatController::class,'edit_vat'])->name('vat.edit');

    Route::put('/{id}', [VatController::class,'update_vat'])->name('vat.update');

    Route::get('/{id}/change_sts', [VatController::class,'vat_change_sts'])->name('vat.change_sts');
    Route::post('/filter', [VatController::class,'vat_info_filter'])->name('vat_info_filter');


});



// Route for Expense
Route::name('admin.')->prefix('/admin/expense')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [ExpenseController::class,'expense'])->name('expense');
    Route::post('/create', [ExpenseController::class,'store_expense'])->name('expense.create');
    Route::get('/edit/{id}', [ExpenseController::class,'edit_expense'])->name('expense.edit');

    Route::put('/{id}', [ExpenseController::class,'update_expense'])->name('expense.update');

    Route::get('/{id}/change_sts', [ExpenseController::class,'expense_change_sts'])->name('expense.change_sts');
    Route::get('/filter', [ExpenseController::class,'expense_info_filter'])->name('expense_info_filter');


});



// Route for Product
Route::name('admin.')->prefix('admin/product')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [ProductController::class,'product'])->name('product');
    Route::post('/create', [ProductController::class,'store_product'])->name('product.create');
    Route::get('/edit/{id}', [ProductController::class,'edit_product'])->name('product.edit');
    Route::put('/{id}', [ProductController::class,'update_product'])->name('product.update');

    Route::get('/{id}/change_sts', [ProductController::class,'product_change_sts'])->name('product.change_sts');
    Route::post('/filter', [ProductController::class,'product_info_filter'])->name('product_info_filter');


});



// Route for Oter_income_save
Route::name('admin.')->prefix('admin/other_income_save')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [OtherIncomeSaveController::class,'other_income_save'])->name('other_income_save');
    Route::post('/create', [OtherIncomeSaveController::class,'store_other_income_save'])->name('other_income_save.create');
    Route::get('/edit/{id}', [OtherIncomeSaveController::class,'edit_other_income_save'])->name('other_income_save.edit');
    Route::put('/{id}', [OtherIncomeSaveController::class,'update_other_income_save'])->name('other_income_save.update');

    Route::get('/{id}/change_sts', [OtherIncomeSaveController::class,'other_income_save_change_sts'])->name('other_income_save.change_sts');
    Route::post('/filter', [OtherIncomeSaveController::class,'other_income_save_info_filter'])->name('other_income_save_info_filter');


});



// Route for Kitchen Role
Route::name('admin.')->prefix('admin/kitchen')->middleware(['auth', 'isSuperAdmin'])->group(function () {


    
    Route::put('/set_kitchen', [KitchenController::class,'set_kitchen_id'])->name('kitchen.role_change');
    

    //Showing All Kitchen User To admin superadmin or editor Set Them With Kitchen

    Route::get('/list', [KitchenController::class,'kitchen_list'])->name('kitchen.list');

});

Route::name('admin.')->prefix('admin/kitchen')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [KitchenController::class,'kitchen'])->name('kitchen');

   

    Route::post('/create', [KitchenController::class,'store_kitchen'])->name('kitchen.create'); 
    Route::get('/edit/{id}', [KitchenController::class,'edit_kitchen'])->name('kitchen.edit');

    Route::put('/{id}', [KitchenController::class,'update_kitchen'])->name('kitchen.update');

  

});

//Admin , Super admin, Cashier Can send panding order to the kitchen using this route.

Route::post('admin/kitchen/send_kitchen', [KitchenController::class,'send_to_kitchen'])->name('admin.kitchen.send_kitchen')->middleware('SendKitchen');

//Kitchen Itmes List.Showing in Kitchen panel list.

Route::get('admin/kitchen/items', [KitchenController::class, 'kitchen_items'])->name('admin.kitchen_items')->middleware('Kitchen');


Route::get('admin/waiter/items', [WaiterController::class, 'waiter_items'])->name('admin.waiter_items')->middleware('Waiter');


Route::post('admin/waiter/send_waiter', [KitchenController::class,'send_to_waiter'])->name('admin.waiter.send_waiter')->middleware('Kitchen');


// Route for Waiter Role
Route::name('admin.')->prefix('admin/waiter')->middleware(['auth', 'isSuperAdmin'])->group(function () {



    Route::put('/set_waiter', [WaiterController::class,'set_waiter_id'])->name('waiter.role_change');


    Route::get('/list', [WaiterController::class,'waiter_list'])->name('waiter.list');


});


Route::name('admin.')->prefix('admin/waiter')->middleware(['auth', 'Dashboard'])->group(function () {
    Route::get('/', [WaiterController::class,'waiter'])->name('waiter');

        

    Route::post('/create', [WaiterController::class,'store_waiter'])->name('waiter.create'); 
    Route::get('/edit/{id}', [WaiterController::class,'edit_waiter'])->name('waiter.edit');

    Route::put('/{id}', [WaiterController::class,'update_waiter'])->name('waiter.update');

  

});


Route::name('admin.')->prefix('admin/table')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [TableNoController::class,'table'])->name('table');

   

    Route::post('/create', [TableNoController::class,'store_table'])->name('table.create'); 
    Route::get('/edit/{id}', [TableNoController::class,'edit_table'])->name('table.edit');

    Route::put('/{id}', [TableNoController::class,'update_table'])->name('table.update');

  

});




// Route for Supplier
Route::name('admin.')->prefix('/admin/supplier')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [supplierController::class,'supplier'])->name('supplier');
    Route::post('/create', [supplierController::class,'store_supplier'])->name('supplier.create');
    Route::get('/edit/{id}', [supplierController::class,'edit_supplier'])->name('supplier.edit');

    Route::put('/{id}', [supplierController::class,'update_supplier'])->name('supplier.update');

    Route::get('/{id}/change_sts', [supplierController::class,'supplier_change_sts'])->name('supplier.change_sts');
    Route::post('/filter', [supplierController::class,'supplier_info_filter'])->name('supplier_info_filter');


});



// Route for Factory
Route::name('admin.')->prefix('/admin/factory')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [factoryController::class,'factory'])->name('factory');
    Route::post('/create', [factoryController::class,'store_factory'])->name('factory.create');
    Route::get('/edit/{id}', [factoryController::class,'edit_factory'])->name('factory.edit');

    Route::put('/{id}', [factoryController::class,'update_factory'])->name('factory.update');

    Route::get('/{id}/change_sts', [factoryController::class,'factory_change_sts'])->name('factory.change_sts');
    Route::post('/filter', [factoryController::class,'factory_info_filter'])->name('factory_info_filter');


});



// Route for Product_mat_setting
Route::name('admin.')->prefix('/admin/product_mat_setting')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [productMaterialSettingsController::class,'product_mat_setting'])->name('product_mat_setting');
    Route::post('/create', [productMaterialSettingsController::class,'store_product_mat_setting'])->name('product_mat_setting.create');
    Route::get('/edit/{id}', [productMaterialSettingsController::class,'edit_product_mat_setting'])->name('product_mat_setting.edit');

    Route::put('/{id}', [productMaterialSettingsController::class,'update_product_mat_setting'])->name('product_mat_setting.update');

    Route::get('/{id}/change_sts', [productMaterialSettingsController::class,'product_mat_setting_change_sts'])->name('product_mat_setting.change_sts');
    Route::post('/filter', [productMaterialSettingsController::class,'product_mat_setting_info_filter'])->name('product_mat_setting_info_filter');


});



// Route for Add_ons_mat_setting
Route::name('admin.')->prefix('/admin/add_ons_mat_setting')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/', [AddOnsMaterialSettingController::class,'add_ons_mat_setting'])->name('add_ons_mat_setting');
    Route::post('/create', [AddOnsMaterialSettingController::class,'store_add_ons_mat_setting'])->name('add_ons_mat_setting.create');
    Route::get('/edit/{id}', [AddOnsMaterialSettingController::class,'edit_add_ons_mat_setting'])->name('add_ons_mat_setting.edit');

    Route::put('/{id}', [AddOnsMaterialSettingController::class,'update_add_ons_mat_setting'])->name('add_ons_mat_setting.update');

    Route::get('/{id}/change_sts', [AddOnsMaterialSettingController::class,'add_ons_mat_setting_change_sts'])->name('add_ons_mat_setting.change_sts');
    Route::post('/filter', [AddOnsMaterialSettingController::class,'add_ons_mat_setting_info_filter'])->name('add_ons_mat_setting_info_filter');


});



// Order Releted Route 

Route::name('admin.')->prefix('/admin/order')->middleware(['auth', 'Dashboard'])->group(function () {


    Route::get('/show_all_data', [OrderController::class,'show_all_data'])->name('order.show_all_data');
    
    Route::get('/confirm/{id}', [OrderController::class,'confirm_order'])->name('order.confirm_order');

    Route::get('/cancel', [OrderController::class,'cancel_order'])->name('order.cancel_order');

    Route::get('/count_order', [OrderController::class,'save_order'])->name('order.count');
    Route::post('/order_product', [OrderController::class,'order_product'])->name('order.order_product');

    Route::get('/product/{id}', [OrderController::class,'product_list'])->name('order.product');


    Route::get('/panding_order/check/{id}', [OrderController::class,'panding_orders_check'])->name('order.panding.check');

    Route::get('/flat_discount', [OrderController::class,'flat_discount'])->name('order.flat_discount');
    // Route::get('/starting_data', [OrderController::class,'starting_data'])->name('order.starting_data');

    Route::get('/parcent_discount', [OrderController::class,'parcent_discount'])->name('order.parcent_discount');
    
    Route::get('/paid_amount', [OrderController::class,'paid_amount'])->name('order.paid_amount');

    // Route::get('/dynamic_info_show', [OrderController::class,'dynamic_info_show'])->name('order.dynamic_info_show');


    Route::get('/advanced_product/{id}', [OrderController::class,'advanced_product_list'])->name('order.advanced.product');
    // Route::get('/advanced_count_order', [OrderController::class,'advanced_save_order'])->name('order.advanced.count');
    Route::get('/advanced_confirm_order', [OrderController::class,'advanced_confirm_order'])->name('order.advanced_confirm_order');
    // Route::get('/show_customer_info', [OrderController::class,'show_customer_info'])->name('order.show_customer_info');



    Route::post('/advanced_panding_filter', [OrderController::class,'advanced_panding_filter'])->name('advanced_panding_filter');

    Route::post('/sale_filter', [OrderController::class,'sale_filter'])->name('sale_filter');


    Route::get('/token_add', [OrderController::class,'token_add'])->name('order.token');
    Route::get('/table_add', [OrderController::class,'table_add'])->name('order.table');

  


});

// Route for Purchase 

Route::name('admin.')->prefix('/admin/purchase')->middleware(['auth', 'Dashboard'])->group(function () { 

    Route::get('/', [PurchaseController::class,'purchase'])->name('purchase');
    Route::post('/count_purchase', [PurchaseController::class,'save_purchase'])->name('purchase.create');
    Route::get('/show_all_data', [PurchaseController::class,'show_all_data'])->name('purchase.show_all_data');
    Route::get('/confirm/{id}', [PurchaseController::class,'confirm_purchase'])->name('purchase.confirm_purchase');


    Route::post('/filter', [PurchaseController::class,'purchase_info_filter'])->name('purchase_info_filter');


    Route::post('/paid_amount', [PurchaseController::class,'paid_amount'])->name('purchase.paid_amount');
    Route::post('/supplier', [PurchaseController::class,'supplier'])->name('purchase.paid_amount');
    // Route::get('/confirm', [PurchaseController::class,'confirm_purchase'])->name('purchase.confirm');
    Route::get('/order_data', [PurchaseController::class,'set_order_data'])->name('purchase.order_data');
    Route::get('/discount', [PurchaseController::class,'discount'])->name('purchase.discount');
    Route::get('/cancel', [PurchaseController::class,'cancel_purchase'])->name('purchase.cancel');



});

//Route for report


Route::name('admin.')->prefix('/admin/report')->middleware(['auth', 'Dashboard'])->group(function () {

    Route::get('/purchase', [PurchaseController::class,'purchase_report'])->name('purchase_report');
    Route::get('/purchase/{id}/details', [PurchaseController::class,'purchase_details'])->name('purchase_details');



    Route::get('/sale', [OrderController::class,'sale_report'])->name('sale_report');
    Route::get('/allsale', [OrderController::class,'all_sale_report'])->name('all.sale_report');



});





// Route For delete (Role for Creator)

Route::middleware(['auth', 'isCreator'])->group(function () {

Route::delete('admin/category/{id}', [CategoryController::class,'delete_category'])->name('admin.category.delete');
Route::delete('admin/flavor/{id}', [FlavorController::class,'delete_flavor'])->name('admin.flavor.delete');
Route::delete('admin/chocolate_flavor/{id}', [ChocolateFlavorController::class,'delete_chocolate_flavor'])->name('admin.chocolate_flavor.delete');
Route::delete('admin/add_ons/{id}', [Add_onsController::class,'delete_add_ons'])->name('admin.add_ons.delete');
Route::delete('admin/raw_material/{id}', [RawMaterialController::class,'delete_raw_material'])->name('admin.raw_material.delete');
Route::delete('admin/counter/{id}', [CounterController::class,'delete_counter'])->name('admin.counter.delete');
Route::delete('admin/fund/{id}', [FundController::class,'delete_fund'])->name('admin.fund.delete');
Route::delete('admin/expense_type/{id}', [ExpenseTypeController::class,'delete_expense_type'])->name('admin.expense_type.delete');
Route::delete('admin/expense_head/{id}', [ExpenseHeadController::class,'delete_expense_head'])->name('admin.expense_head.delete');
Route::delete('admin/other_income/{id}', [OtherIncomeHeadController::class,'delete_other_income'])->name('admin.other_income.delete');
Route::delete('admin/vat/{id}', [VatController::class,'delete_vat'])->name('admin.vat.delete');
Route::delete('admin/kitchen/{id}', [KitchenController::class,'delete_kitchen'])->name('admin.kitchen.delete');
Route::delete('admin/table/{id}', [TableNoController::class,'delete_table'])->name('admin.table.delete');
Route::delete('admin/waiter/{id}', [WaiterController::class,'delete_waiter'])->name('admin.waiter.delete');
Route::delete('admin/expense/{id}', [ExpenseController::class,'delete_expense'])->name('admin.expense.delete');
Route::delete('admin/product/{id}', [ProductController::class,'delete_product'])->name('admin.product.delete');
Route::delete('admin/other_income_save/{id}', [OtherIncomeSaveController::class,'delete_other_income_save'])->name('admin.other_income_save.delete');
Route::delete('admin/supplier/{id}', [supplierController::class,'delete_supplier'])->name('admin.supplier.delete');
Route::delete('admin/factory/{id}', [factoryController::class,'delete_factory'])->name('admin.factory.delete');
Route::delete('admin/product_mat_setting/{id}', [productMaterialSettingsController::class,'delete_product_mat_setting'])->name('admin.product_mat_setting.delete');
Route::delete('admin/add_ons_mat_setting/{id}', [AddOnsMaterialSettingController::class,'delete_add_ons_mat_setting'])->name('admin.add_ons_mat_setting.delete');


Route::get('admin/report/purchase/delete/{id}', [PurchaseController::class,'purchase_delete'])->name('admin.purchase.delete');

Route::delete('admin/purchase/{id}', [PurchaseController::class,'delete_purchase'])->name('admin.purchase.delete');

Route::delete('admin/order/{id}', [OrderController::class,'delete_product'])->name('admin.order.delete');

Route::delete('admin/order/panding_order/{id}', [OrderController::class,'panding_orders_delete'])->name('admin.order.panding.delete');

});


// Route for Auth controll 


//User Account Create/Register 

Route::name('admin.')->prefix('admin/register')->middleware(['auth', 'isSuperAdmin'])->group(function () {

    Route::get('/', [AuthController::class, 'create_account'])->name('account');
    Route::post('/', [AuthController::class, 'store_account'])->name('account_store');

    Route::get('/user_list', [AuthController::class, 'user_list'])->name('user_list');
    Route::delete('/{id}', [AuthController::class,'delete_user'])->name('user.delete');
    Route::put('/role', [AuthController::class, 'changeRole'])->name('user.role');

 
});



// Role For Cashier 

Route::middleware(['auth', 'isCashier'])->group(function () {
    Route::get('/admin/order', [OrderController::class,'order'])->name('admin.order');
    Route::get('/admin/order/panding_order', [OrderController::class,'panding_orders'])->name('admin.order.panding');

    Route::get('/admin/order/advanced_order', [OrderController::class,'advanced_order'])->name('admin.order.advanced');
    Route::get('/admin/order/ad_panding_order', [OrderController::class,'ad_panding_orders'])->name('admin.order.ad_panding');
});


Route::get('admin/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('admin/login', [AuthController::class, 'login_store'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');









































// Route::get('/', function () {
//     return view('welcome');
// });

