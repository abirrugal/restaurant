<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends ApiBaseController
{
    public function purchase(){

  
        $infos = Purchase::all();
        $raw_mat = Raw_Material::where('status','active')->get();
        $factories = factory::where('status','active')->select('name','id','address','balance')->get();
        $fund = Fund::where('status','active')->select('name','id')->get();
        $supplier = supplier::where('status','active')->select('name','id')->get();
    
             if(session('purchase_id') !== null){
            $purchase_id = session('purchase_id');
    
            $order_purchase = OrderPurchase::where('purchase_id',$purchase_id)->get();
    
            }else{
                $order_purchase = null;
            }
    
      return view('backend.purchase.index', compact('infos', 'raw_mat','factories','order_purchase','fund','supplier'));
    
       }
    
    
    //Store purchase 
    
    public function save_purchase(Request $request){
    
       
       $grand_amount = $request->grand_amount;
    
    
    
       $name              =  $request->name;
       $qty               =  $request->qty;
       $rate              =  $request->rate;
       $type              =  $request->type;
       $fund              =  $request->fund;
       $amount            =  $request->amount;
       $supplier_name     =  $request->supplier_name;
       $supplier_address  =  $request->supplier_address;
       $supplier_invoice  =  $request->supplier_invoice;
       $supplier_company  =  $request->supplier_company;
    
    
      $date =Carbon::parse($request->date)
      ->toDateTimeString();
    
    
    
    if(session('purchase_id') === null){
        $reload_true = "yes";
    }
    
    
    
    if(session('purchase_id') === null){
    
        $purchase = Purchase::create([
          
          'date' => $date,
          'fund' => $fund,
          'total_payment' => $amount,
          'purchase_type' => $type,
          'supplier_company' => $supplier_company,
          'supplier_name' => $supplier_name,
          'supplier_address' => $supplier_address,
          'supplier_invoice' => $supplier_invoice,
    
    
    
          ]);
    
         $purchase_id = $purchase->id;
    
    
          session(['purchase_id'=>$purchase_id]);
    
          
    }
    
    
    
    if(session('purchase_id') !== null){
    
      
    
        $purchase_id = session('purchase_id');
    
     $payable = $qty * $rate;
    
    $order_purchase = OrderPurchase::create([
    
        'name' => $name,
        'qty' => $qty,
        'rate' => $rate,
        'payable' => $payable,
        'purchase_id' => $purchase_id,
      
    
    ]);
    
    
    
       $purchase = Purchase::find($purchase_id);
    
    
    
    
    $total_rate = 0;
    
    if ($purchase->total_discount !== null) {
        
        $discount = $purchase->total_discount;
    
    }else{
    
        $discount = 0;
    
    }
    
    foreach($purchase->order_products as $purchase_info){
        
      $total_rate +=  $purchase_info->payable;
    
    };
    
    
    
    $purchase->total_rate = $total_rate;
    $purchase->total_with_discount = $total_rate - $discount;
    
    
    $purchase->save();
    
    
    }
          
            return response()->json($reload_true); 
    
    }
    
    
    public function show_all_data(){
    
        if(session('purchase_id') !== null){
            $purchase_id = session('purchase_id');
    
            $order_purchase = OrderPurchase::where('purchase_sts', 'panding')->where('purchase_id',$purchase_id)->get();
    
            }else{
                $order_purchase = null;
            }
    
            return response()->json($order_purchase);
    
    }
    
    
    public function delete_purchase(Request $request){
    
    $id = session('purchase_id');
    $order_purchase_id = $request->id;
    
    $order_purchase = OrderPurchase::find($order_purchase_id);
    $order_purchase->delete();
    
    
       $purchase = Purchase::find($id);
    
    
    $total_rate = 0;
    
    if ($purchase->total_discount !== null) {
        
        $discount = $purchase->total_discount;
    
    }else{
    
        $discount = 0;
    
    }
    
    foreach($purchase->order_products as $purchase_info){
        
      $total_rate +=  $purchase_info->payable;
    
    
    };
    
    $purchase->total_rate = $total_rate;
    $purchase->total_with_discount = $total_rate - $discount;
    $purchase->save();
    
    
    return response()->json('Deleted Success');
    
    }
    
    
    
    public function paid_amount(Request $request){
    
          $id = session('purchase_id');
        $purchase = Purchase::find($id);
    
    
    
        $confirm_paid = $request->confirm_paid;
        $fund = $request->fund;
    
    
    
        
     $purchase->total_payment = $confirm_paid;
     $purchase->fund = $fund;
    
     $purchase->save();
    
    
    
    return response()->json($purchase);
    }
    
    public function supplier(Request $request){
        $id = session('purchase_id');
        $purchase = Purchase::find($id);
    
    
    
        $supplier_company   = $request->supplier_company;
        $supplier_name      = $request->supplier_name;
        $supplier_address   = $request->supplier_address;
        $supplier_invoice   = $request->supplier_invoice;
    
    
    
        
        $purchase->supplier_company    =   $supplier_company;
        $purchase->supplier_name       =   $supplier_name;
        $purchase->supplier_address    =   $supplier_address;
        $purchase->supplier_invoice    =   $supplier_invoice;
        
        $purchase->save();
    
    
    return response()->json($purchase);
    
    }
    
    
    
    public function confirm_purchase(Request $request, $id){
    
         $id = session('purchase_id');
    
       $purchase = Purchase::find($id);
       
         $date =Carbon::parse($request->date)
      ->toDateTimeString();
       $purchase_type = $request->type;
    
    
    
    
    $total_rate = 0;
    
    foreach($purchase->order_products as $purchase_info){
      $total_rate +=  $purchase_info->payable;
    
    };
    
    
    
    $purchase->total_rate = $total_rate;
    $purchase->date = $date;
    $purchase->purchase_type = $purchase_type;
    
    
    $purchase->save();
    
    $confirm_paid = $purchase->total_payment;
    
    
    
       if(isset($purchase) && $confirm_paid !== null && $confirm_paid > 0){
        $purchase->purchase_status = 'completed';
        $purchase->save();
        foreach ($purchase->order_products as $key => $value) {
    
           
            $value->purchase_sts = 'completed';
            $value->save();
              
          }
       }
    
       if(isset($purchase) && $confirm_paid === null || $confirm_paid < 1){
    
        $purchase->purchase_status = 'review';
        $purchase->save();
    
        foreach ($purchase->order_products as $key => $value) {
    
           
            $value->purchase_sts = 'review';
            $value->save();
              
          }
    
       }
    
          $order = Purchase::find($id);
    
    
       session()->forget('purchase_id');
       $this->successMessage('Purchase Created Success');
    
       return view('backend.report.purchase_details', compact('order'));
    }
    
    
    public function set_order_data(){
        $id = session('purchase_id');
        $purchase = Purchase::find($id);
    
        return response()->json($purchase);
    }
    
    
    public function discount(Request $request){
    
        $flat_dis = $request->flat_dis;
        $percent_dis = $request->percent_dis;
    
        if ($flat_dis !== null && $flat_dis !== 0) {
            $id = session('purchase_id');
            $purchase = Purchase::find($id);
    
            $purchase->total_with_discount = $purchase->total_rate - $flat_dis;
            $purchase->total_discount = $flat_dis;
            $purchase->save();
    
    
        }else if($percent_dis !== null && $percent_dis !== 0){
    
            $id = session('purchase_id');
            $purchase = Purchase::find($id);
            $total_rate = $purchase->total_rate;
    
            $discount_value = ($total_rate / 100) * $percent_dis;
    
            $purchase->total_with_discount = $purchase->total_rate - $discount_value;
    
            $purchase->total_discount = $discount_value;
            $purchase->save();
          
    
        }else{
    
        }
    
        $purchase = Purchase::find(session('purchase_id'));
    
        return response()->json($purchase);
    
    }
    
    
    public function cancel_purchase(){
    
    
    
        // if(session('order_id')){
            $id = session('purchase_id');
    
            $order = Purchase::find($id);
        
        
            
        $order->delete();
        session()->forget('purchase_id');
        $this->successMessage('Purchase Cancelled Success');
    
        return response()->json('Success');
        }
    
    
    
    public function purchase_report(){
       $today_purchase = Purchase::whereDate('created_at', Carbon::today())->paginate(20);
    
    
    
       return view('backend.report.purchase', compact('today_purchase'));
    }
    
    public function purchase_info_filter(Request $request){
    
        $start_date = Carbon::parse($request->start_date)
        ->toDateTimeString();
      
        $end_date = Carbon::parse($request->end_date)
        ->toDateTimeString();
      
     
      
        $today_purchase =  Purchase::whereBetween('date', [$start_date,$end_date])->paginate(20);
      
    return view('backend.report.purchase', compact('today_purchase'));
    
    }
    
    public function purchase_delete($id){
    
        $purchase = Purchase::find($id);
        $purchase->delete();
        $this->successMessage("Deleted success");
        return redirect()->back();
    }
    
    
    public function purchase_details($id){
    
        $order = Purchase::find($id);
    
        return view('backend.report.purchase_details', compact('order'));
    
    
    }
}
