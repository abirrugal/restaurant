<?php

use App\Http\Controllers\api\Add_onsController;
use App\Http\Controllers\api\AddOnsMaterialSettingController;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ChocolateFlavorController;
use App\Http\Controllers\api\CounterController;
use App\Http\Controllers\api\ExpenseController;
use App\Http\Controllers\api\ExpenseHeadController;
use App\Http\Controllers\api\ExpenseTypeController;
use App\Http\Controllers\api\factoryController;
use App\Http\Controllers\api\FlavorController;
use App\Http\Controllers\api\FundController;
use App\Http\Controllers\api\KitchenController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OtherIncomeController;
use App\Http\Controllers\api\OtherIncomeHeadController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\productMaterialSettingsController;
use App\Http\Controllers\api\RawMaterialController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\TableNoController;
use App\Http\Controllers\api\VatController;
use App\Http\Controllers\api\WaiterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->prefix('/v1/flavor')->group(function () {

    Route::get('/', [FlavorController::class,'flavor'])->name('flavor');
    Route::get('/active', [FlavorController::class,'active']);
    Route::post('/create', [FlavorController::class,'store_flavor'])->name('flavor.create');
    Route::put('/{id}', [FlavorController::class,'update_flavor'])->name('flavor.update');
    Route::delete('/{id}', [FlavorController::class,'delete_flavor'])->name('flavor.delete');
    Route::get('/{id}/change_sts', [FlavorController::class,'flavor_change_sts'])->name('flavor.change_sts');

});

Route::name('api.')->prefix('/v1/chocolate_flavor')->group(function () {

    Route::get('/', [ChocolateFlavorController::class,'chocolate_flavor'])->name('chocolate_flavor');
    Route::get('/active', [ChocolateFlavorController::class,'active']);
    Route::post('/create', [ChocolateFlavorController::class,'store_chocolate_flavor'])->name('chocolate_flavor.create');
    Route::put('/{id}', [ChocolateFlavorController::class,'update_chocolate_flavor'])->name('chocolate_flavor.update');
    Route::delete('/{id}', [ChocolateFlavorController::class,'delete_chocolate_flavor'])->name('chocolate_flavor.delete');

    Route::get('/{id}/change_sts', [ChocolateFlavorController::class,'chocolate_flavor_change_sts'])->name('chocolate_flavor.change_sts');


});



Route::name('api.')->prefix('/v1/counter')->group(function () {

    Route::get('/', [CounterController::class,'counter'])->name('counter');
    Route::get('/active', [CounterController::class,'active']);
    Route::post('/create', [CounterController::class,'store_counter'])->name('counter.create');
    Route::put('/{id}', [CounterController::class,'update_counter'])->name('counter.update');
    Route::delete('/{id}', [CounterController::class,'delete_counter'])->name('counter.delete');
    Route::get('/{id}/change_sts', [CounterController::class,'counter_change_sts'])->name('counter.change_sts');


});

Route::name('api.')->prefix('/v1/fund')->group(function () {

    Route::get('/', [FundController::class,'fund'])->name('fund');
    Route::get('/active', [FundController::class,'active']);
    Route::post('/create', [FundController::class,'store_fund'])->name('fund.create');
    Route::put('/{id}', [FundController::class,'update_fund'])->name('fund.update');
    Route::delete('/{id}', [CounterController::class,'delete_counter'])->name('counter.delete');
    Route::get('/{id}/change_sts', [FundController::class,'fund_change_sts'])->name('fund.change_sts');


});

Route::name('api.')->prefix('/v1/category')->group(function () {

    Route::get('/', [CategoryController::class,'category'])->name('category');
    Route::get('/active', [CategoryController::class,'active'])->name('category.active');
    Route::post('/create', [CategoryController::class,'store_category'])->name('category.create');
    Route::put('/{id}', [CategoryController::class,'update_category'])->name('category.update');
    Route::delete('/{id}', [CategoryController::class,'delete_category'])->name('category.delete');
    Route::get('/{id}/change_sts', [CategoryController::class,'category_change_sts'])->name('category.change_sts');


});

Route::name('api.')->prefix('/v1/add_ons')->group(function () {

    Route::get('/', [Add_onsController::class,'add_ons'])->name('add_ons');
    Route::get('/active', [Add_onsController::class,'active'])->name('category.active');
    Route::post('/create', [Add_onsController::class,'store_add_ons'])->name('add_ons.create');
    Route::put('/{id}', [Add_onsController::class,'update_add_ons'])->name('add_ons.update');
    Route::delete('/{id}', [Add_onsController::class,'delete_add_ons'])->name('add_ons.delete');
    Route::get('/{id}/change_sts', [Add_onsController::class,'add_ons_change_sts'])->name('add_ons.change_sts');

});

Route::name('api.')->prefix('/v1/expense')->group(function () {

    Route::get('/', [ExpenseController::class,'expense'])->name('expense');
    Route::post('/create', [ExpenseController::class,'store_expense'])->name('expense.create');

    Route::put('/{id}', [ExpenseController::class,'update_expense'])->name('expense.update');
    Route::delete('/{id}', [ExpenseController::class,'delete_expense'])->name('expense.delete');

    Route::get('/{id}/change_sts', [ExpenseController::class,'expense_change_sts'])->name('expense.change_sts');
    Route::post('/filter', [ExpenseController::class,'expense_info_filter'])->name('expense_info_filter');

});


Route::name('api.')->prefix('/v1/expense_type')->group(function () {

    Route::get('/', [ExpenseTypeController::class,'expense_type'])->name('expense_type');
    Route::get('/active', [ExpenseTypeController::class,'active']);
    Route::post('/create', [ExpenseTypeController::class,'store_expense_type'])->name('expense_type.create');
    Route::put('/{id}', [ExpenseTypeController::class,'update_expense_type'])->name('expense_type.update');
    Route::delete('/{id}', [ExpenseTypeController::class,'delete_expense_type'])->name('expense_type.delete');
    Route::get('/{id}/change_sts', [ExpenseTypeController::class,'expense_type_change_sts'])->name('expense_type.change_sts');


});


Route::name('api.')->prefix('/v1/factory')->group(function () {

    Route::get('/', [factoryController::class,'factory'])->name('factory');
    Route::get('/active', [factoryController::class,'active']);
    Route::post('/create', [factoryController::class,'store_factory'])->name('factory.create');
    Route::put('/{id}', [factoryController::class,'update_factory'])->name('factory.update');
    Route::get('/{id}/change_sts', [factoryController::class,'factory_change_sts'])->name('factory.change_sts');
    Route::delete('/{id}', [factoryController::class,'delete_factory'])->name('factory.delete');



});


Route::name('api.')->prefix('/v1/vat')->group(function () {

    Route::get('/', [VatController::class,'vat'])->name('vat');
    Route::get('/active', [VatController::class,'active']);
    Route::post('/create', [VatController::class,'store_vat'])->name('vat.create'); 

    Route::put('/{id}', [VatController::class,'update_vat'])->name('vat.update');
    Route::delete('/{id}', [VatController::class,'delete_vat'])->name('vat.delete');

    Route::get('/{id}/change_sts', [VatController::class,'vat_change_sts'])->name('vat.change_sts');


});


Route::name('api.')->prefix('/v1/table')->group(function () {

    Route::get('/', [TableNoController::class,'table'])->name('table');

    Route::post('/create', [TableNoController::class,'store_table'])->name('table.create'); 
    Route::delete('/{id}', [TableNoController::class,'delete_vat'])->name('table.delete');

    Route::put('/{id}', [TableNoController::class,'update_table'])->name('table.update');

});


Route::name('api.')->prefix('/v1/supplier')->group(function () {

    Route::get('/', [supplierController::class,'supplier'])->name('supplier');
    Route::get('/active', [supplierController::class,'active']);

    Route::post('/create', [supplierController::class,'store_supplier'])->name('supplier.create');

    Route::put('/{id}', [supplierController::class,'update_supplier'])->name('supplier.update');
    Route::delete('/{id}', [supplierController::class,'delete_supplier'])->name('supplier.delete');

    Route::get('/{id}/change_sts', [SupplierController::class,'supplier_change_sts'])->name('supplier.change_sts');

});

Route::name('api.')->prefix('/v1/raw_material')->group(function () {

    Route::get('/', [RawMaterialController::class,'raw_material'])->name('raw_material');
    Route::get('/active', [RawMaterialController::class,'active']);
    Route::post('/create', [RawMaterialController::class,'store_raw_material'])->name('raw_material.create');

    Route::put('/{id}', [RawMaterialController::class,'update_raw_material'])->name('raw_material.update');
    Route::delete('/{id}', [RawMaterialController::class,'delete_raw_material'])->name('raw_material.delete');

    Route::get('/{id}/change_sts', [RawMaterialController::class,'raw_material_change_sts'])->name('raw_material.change_sts');


});


Route::name('api.')->prefix('/v1/other_income_head')->group(function () {


    Route::get('/', [OtherIncomeHeadController::class,'other_income'])->name('other_income');
    Route::get('/active', [OtherIncomeHeadController::class,'active']);

    Route::post('/create', [OtherIncomeHeadController::class,'store_other_income'])->name('other_income.create');
    Route::get('/edit/{id}', [OtherIncomeHeadController::class,'edit_other_income'])->name('other_income.edit_data');

    Route::put('/{id}', [OtherIncomeHeadController::class,'update_other_income'])->name('other_income.update');
    Route::delete('/{id}', [OtherIncomeHeadController::class,'delete_other_income'])->name('other_income.delete');

    Route::get('/{id}/change_sts', [OtherIncomeHeadController::class,'other_income_change_sts'])->name('other_income.change_sts');
    Route::post('/filter', [OtherIncomeHeadController::class,'other_income_info_filter'])->name('other_income_info_filter');


});


Route::name('api.')->prefix('/v1/add_ons_mat_setting')->group(function () {


    Route::get('/', [AddOnsMaterialSettingController::class,'add_ons_mat_setting'])->name('add_ons_mat_setting');
    Route::get('/active', [AddOnsMaterialSettingController::class,'active']);

    Route::post('/create', [AddOnsMaterialSettingController::class,'store_add_ons_mat_setting'])->name('add_ons_mat_setting.create');

    Route::put('/{id}', [AddOnsMaterialSettingController::class,'update_add_ons_mat_setting'])->name('add_ons_mat_setting.update');
    Route::delete('/{id}', [AddOnsMaterialSettingController::class,'delete_add_ons_mat_setting'])->name('add_ons_mat_setting.delete');

    Route::get('/{id}/change_sts', [AddOnsMaterialSettingController::class,'add_ons_mat_setting_change_sts'])->name('add_ons_mat_setting.change_sts');


});


Route::name('api.')->prefix('/v1/expense_head')->group(function () {


    Route::get('/', [ExpenseHeadController::class,'expense_head'])->name('expense_head');
    Route::get('/active', [ExpenseHeadController::class,'active']);

    Route::post('/create', [ExpenseHeadController::class,'store_expense_head'])->name('expense_head.create');
    Route::put('/{id}', [ExpenseHeadController::class,'update_expense_head'])->name('expense_head.update');
    Route::delete('/{id}', [ExpenseHeadController::class,'delete_expense_head'])->name('expense_head.delete');

    Route::get('/{id}/change_sts', [ExpenseHeadController::class,'expense_head_change_sts'])->name('expense_head.change_sts');

});


Route::name('api.')->prefix('/v1/other_income')->group(function () {


    Route::get('/', [OtherIncomeController::class,'other_income_save'])->name('other_income_save');
    Route::post('/create', [OtherIncomeController::class,'store_other_income_save'])->name('other_income_save.create');
    // Route::get('/edit/{id}', [OtherIncomeController::class,'edit_other_income_save'])->name('other_income_save.edit');
    Route::put('/{id}', [OtherIncomeController::class,'update_other_income_save'])->name('other_income_save.update');
    Route::delete('/{id}', [OtherIncomeController::class,'delete_other_income_save'])->name('other_income.delete');

    Route::get('/{id}/change_sts', [OtherIncomeController::class,'other_income_save_change_sts'])->name('other_income_save.change_sts');
    Route::post('/filter', [OtherIncomeController::class,'other_income_save_info_filter'])->name('other_income_save_info_filter');

});


Route::name('api.')->prefix('/v1/product')->group(function () {


    Route::get('/', [ProductController::class,'product'])->name('product');
    Route::post('/create', [ProductController::class,'store_product'])->name('product.create');
    Route::put('/{id}', [ProductController::class,'update_product'])->name('product.update');
    Route::delete('/{id}', [ProductController::class,'delete_product'])->name('product.delete');

    Route::get('/{id}/change_sts', [ProductController::class,'product_change_sts'])->name('product.change_sts');

});



// -------------------- Kitchen Start ----------------------

// Middleware:-  ->middleware(['auth', 'Dashboard'])

Route::name('api.')->prefix('/v1/kitchen')->group(function () {


    Route::get('/', [KitchenController::class,'kitchen'])->name('kitchen');


    Route::post('/create', [KitchenController::class,'store_kitchen'])->name('kitchen.create'); 
    Route::get('/edit/{id}', [KitchenController::class,'edit_kitchen'])->name('kitchen.edit');

    Route::put('/{id}', [KitchenController::class,'update_kitchen'])->name('kitchen.update');

    Route::delete('/{id}', [KitchenController::class,'delete_kitchen'])->name('kitchen.delete');


});


//Admin , Super admin, Cashier Can send panding order to the kitchen using this route.
// Middleware:-  ->middleware(['auth', 'SendKitchen'])

Route::post('/send_kitchen', [KitchenController::class,'send_to_kitchen'])->name('admin.kitchen.send_kitchen')->middleware('SendKitchen');




// Route for Kitchen Role

// Middleware:-  ->middleware(['auth', 'isSuperAdmin'])

Route::name('api.')->prefix('/v1/kitchen')->group(function () {


    
    Route::put('/set_kitchen', [KitchenController::class,'set_kitchen_id'])->name('kitchen.role_change');
    

    //Showing All Kitchen User To admin superadmin or editor Set Them With Kitchen

    Route::get('/user', [KitchenController::class,'permited_kitchen_user']);

});


// Middleware:-  ->middleware(['auth', 'Kitchen'])

Route::name('api.')->prefix('/v1/kitchen')->group(function () {

//Kitchen Itmes List.Showing in Kitchen panel list.

Route::get('/items', [KitchenController::class, 'kitchen_items']);

//Items Send To Waiter Panel
Route::post('/send_waiter', [KitchenController::class,'send_to_waiter']);


});


// -------------------- Kitchen End ----------------------


// -------------------- Waiter Start ----------------------


// Route for Waiter Role

// Middleware:-  ->middleware(['auth', 'isSuperAdmin'])

Route::name('api.')->prefix('/v1/waiter')->group(function () {


    Route::put('/set_waiter', [WaiterController::class,'set_waiter_id'])->name('waiter.role_change');


    Route::get('/list', [WaiterController::class,'permited_waiter_user']);

    
});


// Middleware:-  ->middleware(['auth', 'Dashboard'])

Route::name('api.')->prefix('/v1/waiter')->group(function () {


    Route::get('/', [WaiterController::class,'waiter'])->name('waiter');

        

    Route::post('/create', [WaiterController::class,'store_waiter'])->name('waiter.create'); 

    Route::put('/{id}', [WaiterController::class,'update_waiter'])->name('waiter.update');

});

// Middleware:-  ->middleware(['auth', 'Waiter'])

Route::get('admin/waiter/items', [WaiterController::class, 'waiter_items'])->name('admin.waiter_items')->middleware('Waiter');


// -------------------- Kitchen End ----------------------


Route::name('api.')->prefix('/v1/product_mat_setting')->group(function () {


    Route::get('/', [productMaterialSettingsController::class,'product_mat_setting'])->name('product_mat_setting');
    Route::post('/create', [productMaterialSettingsController::class,'store_product_mat_setting'])->name('product_mat_setting.create');

    Route::put('/{id}', [productMaterialSettingsController::class,'update_product_mat_setting'])->name('product_mat_setting.update');

    Route::get('/{id}/change_sts', [productMaterialSettingsController::class,'product_mat_setting_change_sts'])->name('product_mat_setting.change_sts');


});


// Order Releted Route 

Route::name('admin.')->prefix('/v1/order')->group(function () {


    Route::get('/show_all_data', [OrderController::class,'show_all_data'])->name('order.show_all_data');
    
    Route::get('/confirm/{id}', [OrderController::class,'confirm_order'])->name('order.confirm_order');

    Route::get('/cancel', [OrderController::class,'cancel_order'])->name('order.cancel_order');

    Route::get('/count_order', [OrderController::class,'save_order'])->name('order.count');
    Route::post('/order_product', [OrderController::class,'order_product'])->name('order.order_product');


    //Category 
    Route::get('/category/{id}', [OrderController::class,'category_list'])->name('order.category');
    Route::get('/product/{id}', [OrderController::class,'product_list'])->name('order.product');


    Route::get('/panding_order/check/{id}', [OrderController::class,'panding_orders_check'])->name('order.panding.check');

    Route::get('/flat_discount', [OrderController::class,'flat_discount'])->name('order.flat_discount');
    // Route::get('/starting_data', [OrderController::class,'starting_data'])->name('order.starting_data');

    Route::get('/parcent_discount', [OrderController::class,'parcent_discount'])->name('order.parcent_discount');
    
    Route::get('/paid_amount', [OrderController::class,'paid_amount'])->name('order.paid_amount');



    Route::get('/advanced_product/{id}', [OrderController::class,'advanced_product_list'])->name('order.advanced.product');
    // Route::get('/advanced_count_order', [OrderController::class,'advanced_save_order'])->name('order.advanced.count');
    Route::get('/advanced_confirm_order', [OrderController::class,'advanced_confirm_order'])->name('order.advanced_confirm_order');
    // Route::get('/show_customer_info', [OrderController::class,'show_customer_info'])->name('order.show_customer_info');



    Route::post('/advanced_panding_filter', [OrderController::class,'advanced_panding_filter'])->name('advanced_panding_filter');

    Route::post('/sale_filter', [OrderController::class,'sale_filter'])->name('sale_filter');


    Route::get('/token_add', [OrderController::class,'token_add'])->name('order.token');
    Route::get('/table_add', [OrderController::class,'table_add'])->name('order.table');

  


});


// Role For Cashier 

// Middleware:-  ->middleware(['auth', 'isCashier'])

Route::prefix('/v1/order')->group(function () {
    // Route::get('/', [OrderController::class,'order'])->name('admin.order');
    Route::get('/panding_order', [OrderController::class,'panding_orders'])->name('admin.order.panding');

    Route::get('/advanced_order', [OrderController::class,'advanced_order'])->name('admin.order.advanced');
    Route::get('/ad_panding_order', [OrderController::class,'ad_panding_orders'])->name('admin.order.ad_panding');
});



//register new user


Route::post('/register', [AuthenticationController::class, 'register']);
//login user
Route::post('/login', [AuthenticationController::class, 'login']);
//Using Middleware

//Profile
Route::post('/profile', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');
//Logout
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

