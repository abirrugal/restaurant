<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
   public function adminHome(){

    $panding_order = Order::where('order_status','review')->count();
    $panding_advanced = Order::where('order_status','adreview')->count();
    $total_sale = Order::where('order_status','completed')->whereDate('updated_at', Carbon::today())->count(); 
    $all_sale = Order::where('order_status', 'completed')->count();
    $monthly_sale = Order::where('order_status', 'completed')->select('*')
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();

    $total_product = Product::where('status', 'active')->count();

    $superadmin = User::where('role_as','superadmin')->count();
    $admin = User::where('role_as','admin')->count();
    $editor = User::where('role_as','editor')->count();
    $kitchen = User::where('role_as','kitchen')->count();
    $waiter = User::where('role_as','waiter')->count();
   
       return view('backend.admin.index' ,compact('panding_order','panding_advanced','total_sale','total_product','superadmin','admin','waiter','editor','kitchen','all_sale','monthly_sale'));
   }
}
