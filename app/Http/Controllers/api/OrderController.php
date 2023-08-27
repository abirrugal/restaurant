<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Add_ons;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends ApiBaseController
{
    


    public function token_add(Request $request){
  
      $token = $request->token_value;
  


      if(session('order_id')){
  
    
        if(session('order_id') !== null ){
          $order_id = session('order_id');
    
          Order::find($order_id)->update([
    
            'token' => $token,
          ]);
        //   return response()->json('Token Added Success');
          return $this->sendResponse([],'Token Added Success');

    
        }else{
        //   return response()->json('Please Enter Token First.');
          return $this->sendResponse([],'Please Enter Token First.');

        }
      }else{
        //   return response()->json('Please add at least one item then set Token.');
          return $this->sendResponse([],'Please add at least one item then set Token.');

        }
  
  
    }
  
  
    public function table_add(Request $request){
  
      $table_no = $request->table_no;
  
      if(session('order_id')){
  
    
      if(session('order_id') !== null){
        $order_id = session('order_id');
  
        Order::find($order_id)->update([
  
          'table_no' => $table_no,
        ]);
        // return response()->json('Table Number Added Success');
        return $this->sendResponse([],'Table Number Added Success');

  
      }else{
        // return response()->json('Please Enter Table Number First.');
        return $this->sendResponse([],'Please Enter Table Number First.');

      }
    }else{
        // return response()->json('Please add at least one item then set table number.');
        return $this->sendResponse([],'Please add at least one item then set table number.');

      }
    }
  
  
    //   public function order(){
    //       $categories = Category::with('products')->get();
    //       $products = Product::latest()->paginate(20);
    //       $flavor = Flavor::where('status','active')->select('name','id')->get();
    //       $c_flavor = Chocolate_flavor::where('status','active')->select('name','id')->get();
    //       $funds = Fund::where('status','active')->get();
    //       $tables = TableNo::all();
    //       $addones = Add_ons::all();
  
    //       if(session('order_id') !== null){
    //       $order_id = session('order_id');
  
    //       $order_products = OrderProducts::where('order_id',$order_id)->get();
  
    //       }else{
    //           $order_products = null;
    //       }
    //       return view('backend.order.order',compact('categories','products','flavor','c_flavor','funds','order_products','tables','addones'));
    //   }

    
  
      public function product_list($id){
        //   $categories = Category::with('products')->get();
         $category = Category::find($id);
         $products = Product::where('category_id', $category->id)->paginate(20);
        //  $category_id = $id;
        //  $flavor = Flavor::where('status','active')->select('name','id')->get();
        //  $c_flavor = Chocolate_flavor::where('status','active')->select('name','id')->get();
        //  $funds = Fund::where('status','active')->get();
        //  $tables = TableNo::all();
        //  $addones = Add_ons::all();
  
  
        return $this->sendResponse(['products' => $products, 'category' => $category ],'Product list of selected Category.');
  
      }

      
  
      public function save_order(Request $request){
  
      
        $grand_amount = $request->grand_amount;
        $payable_amount = $request->payable_amount;
        $vat_amount =  $request->vat_amount;
        $fee =  $request->fee;
        $id = $request->product_id;
        $parcel_sts = $request->parcel_sts;
        $product_qty = $request->product_qty;
        $discount_amount = $request->discount_amount;
        $flavor = $request->flavor;
        $c_flavor = $request->c_flavor;
        $fund = $request->fund;
        $token_value = $request->token_value;
  
  $product = Product::find($request->product_id);
  
  $product_name = $product->name;
  
  
  if(session('order_id') === null){
      $reload_true = "yes";
  }
  
  
  
  
  if(session('order_id') === null){
  
      $order = Order::create([
          'parcel_status' => $parcel_sts,
          'fund' => $fund,
          'order_type' => 'normal',
          'token' => $token_value,
        ]);
  
       $order_id = $order->id;
  
  
        session(['order_id'=>$order_id]);
  
        
  
  }
  
  
  
  if(session('order_id') !== null){
  
    
  
      $order_id = session('order_id');
  
      if($token_value !== null && $token_value !== ''){
        $order =  Order::find($order_id);
        $order->token = $token_value;
        $order->save();
      }
  
  OrderProducts::create([
  
      'order_id' =>$order_id,
      'name' => $product_name,
      'qty' => $product_qty,
      'rate' => $grand_amount,
      'vat' => $vat_amount,
      'discount' => $discount_amount,
      'payable' => $payable_amount,
      'flavor' => $flavor,
      'cflavor' => $c_flavor
  
  
  
  ]);
  
  
  
  
  }
  
  
          
  return $this->sendResponse([],'Item Added Success');
  
          
      }
  
  
  
    //   public function order_product(Request $request){
  
    //       $grand_amount = $request->grand_amount;
    //       $vat_amount =  $request->vat_amount;
    //       $fee =  $request->fee;
    //       $id = $request->id;
    //       $parcel_sts = $request->parcel_sts;
    //       $product_qty = $request->product_qty;
    //       $discount_amount = $request->discount_amount;
    //       $flavor = $request->flavor;
    //       $c_flavor = $request->c_flavor;
    //       $fund = $request->fund;
    
    // $product = Product::find($id);
    
  
  
    //   }


  
  public function delete_product(Request $request){
  
  $id = $request->id;
  
  $order_product = OrderProducts::find($id);
  $order_product->delete();
  
  return $this->sendResponse([],'Deleted Success');
  
  }


  
  public function show_all_data(){
  
      if(session('order_id') !== null){
          $order_id = session('order_id');
  
          $order_products = OrderProducts::where('order_sts', 'panding')->where('order_id',$order_id)->get();
  
          }else{
              $order_products = null;
          }
  
          return $this->sendResponse($order_products,'All Added Product Items.');
        }
  
  
  
  public function confirm_order(Request $request, $id){
  
   
     $order = Order::find($id);
  
     $confirm_paid = $request->paid;
  
  
  
  $total = 0;
  $total_rate = 0;
  $total_vat = 0;
  
  foreach($order->order_products as $order_info){
    $total +=  $order_info->payable;
    $total_rate +=  $order_info->rate;
    $total_vat +=  $order_info->vat;
  
  };
  
  $order->total = $total;
  $order->total_rate = $total_rate;
  $order->total_vat = $total_vat;
  
  $order->save();
  
  
  
 
    $order_id = session('order_id');
  
  $order = Order::find($order_id);
  
    $input = $request->all();
  $input['addone_ids'] = $request->input('addone_ids');
  
   
  if($input['addone_ids'] !== null){
  
  
  foreach($input['addone_ids'] as $value){
  
      $addone = Add_ons::find($value);
        $name =  $addone->name;
        $price =  $addone->price;
  
      
   
     $order->order_add_ons()->create([
  
         'name' => $name,
         'price' => $price,
       
     ]);
  
  
  
  }
  
  }
  
  
  
  
  
  
  
     if(isset($order) && $confirm_paid !== null && $confirm_paid > 0){
      $order->order_status = 'completed';
      $order->save();
      foreach ($order->order_products as $key => $value) {
  
         
          $value->order_sts = 'completed';
          $value->save();
            
        }
     }
  
     if(isset($order) && $confirm_paid === null || $confirm_paid < 1){
  
      $order->order_status = 'review';
      $order->save();
  
      foreach ($order->order_products as $key => $value) {
  
         
          $value->order_sts = 'review';
          $value->save();
            
        }
  
     }
  
  
  
  
     session()->forget('order_id');

     return $this->sendResponse([],'Order Created Success');

 
  }



  
  public function cancel_order(Request $request){
  
      // if(session('order_id')){
          $id = session('order_id');
  
          $order = Order::find($id);
      
      
          
      $order->delete();
      session()->forget('order_id');

  
       return $this->sendResponse([],'Order Cancelled Success');

      }
  
     
  public function panding_orders(){
      $panding_orders = Order::where('order_status', 'review')->latest()->get();
     
      return $this->sendResponse($panding_orders,'Panding Order List.');
    }
  
  public function panding_orders_delete($id){
  
      $panding_order = Order::find($id);
      $panding_order->delete();

      return $this->sendResponse([],'Panding Order Deleted Success.');

  }
  
  public function panding_orders_check($id){
  
      $panding_order = Order::find($id);
      $panding_order->order_status = 'completed';
      $panding_order->save();

      return $this->sendResponse([],'Panding Order Save As Completed Order Success.');
  }
  
    ///////// //FLAT DISCOUNT//////////
  //   ------------------------------------
  
  
  public function flat_discount(Request $request){
  
      $id = session('order_id');
      $order = Order::find($id);
  
      $total = 0;
     $vat = 0;
     $payable = 0;
  
  
  foreach($order->order_products as $order_info){
    $total +=  $order_info->rate;
    $vat += $order_info->vat;
    $payable += $order_info->payable;
    
  
  };
  
      $total_amount = $payable;
  
      //User's given discount
      $flat_discount = $request->flat_dis;
  
    
            $total_with_discount = $total_amount - $flat_discount;
            $order->total_with_discount = $total_with_discount;
  
            //User's given discount save to total discount
            $order->total_discount = $flat_discount;
    
  
    
   $order->total_vat = $vat;
   
   $order->total = $total;
   $order->save();
  
  
  
   return $this->sendResponse([],'Flat Discount Applied Success.');

      
  }
  
  public function parcent_discount(Request $request){
  
  
       $id = session('order_id');
      $order = Order::find($id);
  
      $total = 0;
    $vat = 0;
    $payable = 0;
  
  foreach($order->order_products as $order_info){
    $total +=  $order_info->rate;
    $vat += $order_info->vat;
    $payable += $order_info->payable;
  
  
  };
  
      $total_amount = $payable;
  
      //User's given % discount
      $percentage_discount = $request->pecentage_entry_value;
  
      //Reduced discount amount
  $discount_value = ($total_amount / 100) * $percentage_discount;
     
  
  
       $dis_init_value = (int) $discount_value;
  
      // if (isset($percentage_discount)) {
           $total_with_discount = $total_amount - $dis_init_value;
  
            $order->total_with_discount = $total_with_discount;
           $order->total_discount = $dis_init_value;
      // }
  
   $order->percent_discount = $percentage_discount;
   $order->total_vat = $vat;
   $order->total = $total;
   $order->save();
  
  
  
   return $this->sendResponse([],'Percent Discount Applied Success.');
  
  }
  
  
  // public function dynamic_info_show(){
  
  //     $id = session('order_id');
  //     $order = Order::find($id);
  
  //     $total = 0;
  //    $vat = 0;
  //    $payable = 0;
  
  
  // foreach($order->order_products as $order_info){
  //   $total +=  $order_info->rate;
  //   $vat += $order_info->vat;
  //   $payable += $order_info->payable;
  
  // };
  
  // if (isset($order->total_discount)) {
    
  // }else{
  //  $order->total_with_discount = $payable;
  // }
  
  // $order->total = $total;
  
  // $order->total_vat = $vat;
  
  
  
  // }
  
  
  
  public function paid_amount(Request $request){
  
        $id = session('order_id');
      $order = Order::find($id);
  
  //     $total = 0;
  
  
  // foreach($order->order_products as $order_info){
  //   $total +=  $order_info->payable;
  
  
  // };
  
      // $total_amount = $total;
      $confirm_paid = $request->confirm_paid;
      $fund_name = $request->fund_name;
  
  
      
  
      
   $order->total_payment = $confirm_paid;
   $order->fund = $fund_name;
  //  $order->total = $total_amount;
   $order->save();
  
  
  
   return $this->sendResponse([],'Paid Ammount Set Success.');
  }
  
  
  
  
  // Advanced Order Section 
  //-------------------------------
  //---------------------------------
  //-------------------------------------
  //-----------------------------------------
  
  
  public function ad_panding_orders(){
      $panding_orders = Order::where('order_status', 'adreview')->latest()->paginate(20);
      return $this->sendResponse($panding_orders,'Advanced Panding Order List. (Waiting Advanced Delivery.');
    }
  
  
  
  
  
  
  // public function advanced_order(){
  //     $categories = Category::with('products')->get();
  //     $products = Product::latest()->paginate(20);
  //     $flavor = Flavor::where('status','active')->select('name','id')->get();
  //     $c_flavor = Chocolate_flavor::where('status','active')->select('name','id')->get();
  //     $funds = Fund::where('status','active')->get();
  //     $addones = Add_ons::all();
  
  //     if(session('order_id') !== null){
  //     $order_id = session('order_id');
  
  //     $order_products = OrderProducts::where('order_id',$order_id)->get();
  
  //     }else{
  //         $order_products = null;
  //     }
      
  //     return $this->sendResponse($panding_orders,'Advanced Panding Order List.');
  // }
  
  



  // public function advanced_product_list($id){
  //     $categories = Category::with('products')->get();
  //     $category = Category::find($id);
  //    $products = Product::where('category_id', $category->id)->paginate(20);
  //    $category_id = $id;
  //    $flavor = Flavor::where('status','active')->select('name','id')->get();
  //    $c_flavor = Chocolate_flavor::where('status','active')->select('name','id')->get();
  //    $funds = Fund::where('status','active')->get();
  //    $addones = Add_ons::all();
  
  //     if(session('order_id') !== null){
  //     $order_id = session('order_id');
  
  //     $order_products = OrderProducts::where('order_id',$order_id)->get();
      
  //     }else{
  //         $order_products = null;
  
  //     }
  
  //    return view('backend.order.advanced',compact('products', 'categories','category_id','flavor','c_flavor','funds','order_products','addones'));
  
  // }
  

  
  
  public function advanced_confirm_order(Request $request){

 
    $id = session('order_id');
    $order = Order::find($id);
  
    $confirm_paid = $request->confirm_paid;
  
      $date =Carbon::parse($request->delivery_date)
     ->toDateTimeString();
  
    $delivery_date = $date ;
    $customer_name = $request->customer_name;
    $customer_contact_number = $request->customer_contact_number;
    $customer_address = $request->customer_address;
    $order_note = $request->order_note;
  
  
    $confirm_paid = $request->paid;
  
    $date =Carbon::parse($delivery_date)
    ->toDateTimeString();
  
    $order->delivery_date = $date;
    $order->customer_name = $customer_name;
    $order->customer_number = $customer_contact_number;
    $order->customer_address = $customer_address;
    $order->note = $order_note;
    $order->save();
  
  $total = 0;
  $total_rate = 0;
  $total_vat = 0;
  
  foreach($order->order_products as $order_info){
   $total +=  $order_info->payable;
   $total_rate +=  $order_info->rate;
   $total_vat +=  $order_info->vat;
  
  };
  
  $order->total = $total;
  $order->total_rate = $total_rate;
  $order->total_vat = $total_vat;
  
  $order->save();
  
  
  
  
  
  
   $order_id = session('order_id');
  
  $order = Order::find($order_id);
  
   $input = $request->all();
  $input['addone_ids'] = $request->input('addone_ids');
  
  
  if($input['addone_ids'] !== null){
  
  
  foreach($input['addone_ids'] as $value){
  
     $addone = Add_ons::find($value);
       $name =  $addone->name;
       $price =  $addone->price;
  
     
  
    $order->order_add_ons()->create([
  
        'name' => $name,
        'price' => $price,
      
    ]);
  
  
  
  }
  
  }
  
  
  
  
  
    if(isset($order) && $confirm_paid !== null && $confirm_paid > 0){
     $order->order_status = 'completed';
     $order->save();
     foreach ($order->order_products as $key => $value) {
  
        
         $value->order_sts = 'completed';
         $value->save();
           
       }
    }
  
    if(isset($order) && $confirm_paid === null || $confirm_paid < 1){
  
     $order->order_status = 'review';
     $order->save();
  
     foreach ($order->order_products as $key => $value) {
  
        
         $value->order_sts = 'review';
         $value->save();
           
       }
  
    }
  
  
  
    return $this->sendResponse([],'Advanced Order Confirmed Success');
  }
  
  


  // public function show_customer_info(){
  
  //     if(session('order_id') !== null){
  //         $order_id = session('order_id');
  
  //         $order = Order::find($order_id);
  
  //         }else{
  //             $order = null;
  //         }
  
  //         return response()->json($order);
  // }
  
  
  public function advanced_panding_filter(Request $request){
  
  
      $start_date = Carbon::parse($request->start_date)
      ->toDateTimeString();
    
      $end_date = Carbon::parse($request->end_date)
      ->toDateTimeString();
    
      $number = $request->number;
  
   
      // where('order_type','advanced')->
      $panding_orders =  Order::where('order_status','adreview')->whereBetween('delivery_date', [$start_date,$end_date])->paginate(20);
    
      if ($number !== null){
     $panding_orders = Order::query()
      ->where('customer_number', 'LIKE', "%{$number}%")->paginate(20);
      }
   
    
      return view('backend.order.ad_panding', compact('panding_orders'));
    
    
  }
  
  
  public function sale_report(){
    
       $today_sale = Order::where('order_status','completed')->whereDate('updated_at', Carbon::today())->latest()->paginate(20);
  
     return view('backend.report.sale', compact('today_sale'));
  
  }
  
  public function all_sale_report(){
    
       $today_sale = Order::where('order_status','completed')->latest()->paginate(20);
  
     return view('backend.report.sale', compact('today_sale'));
  
  }
  
  
  public function sale_filter(Request $request){
  
        $start_date = Carbon::parse($request->start_date)
      ->toDateTimeString();
    
      $end_date = Carbon::parse($request->end_date)
      ->toDateTimeString();
    
   
    
      $today_sale =  Order::where('order_status','completed')->whereBetween('updated_at', [$start_date,$end_date])->paginate(20);
    
  return view('backend.report.sale', compact('today_sale'));
  
  }
  
  
  
}
