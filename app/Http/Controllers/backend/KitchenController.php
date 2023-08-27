<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KitchenController extends Controller
{


// Kitchen Items 

public function kitchen_items(){

  if(auth()->user()->role_as !== 'kitchen'){
    $waiters = Waiter::all();
  $panding_orders = Order::where('order_status', 'kitchen')->paginate(20);
  return view('backend.kitchen.panding' , compact('panding_orders','waiters'));
}else{
  $waiters = Waiter::all();
  $panding_orders = Order::where('order_status', 'kitchen')->where('kitchen_id', auth()->user()->kitchen_id)->paginate(20);
  return view('backend.kitchen.panding' , compact('panding_orders','waiters'));
}



}


    public function kitchen_list(){
        $kitchen_list = Kitchen::all();
        $user_list = User::where('role_as', 'kitchen')->get();
        return view('backend.auth.kitchen_role', compact('kitchen_list','user_list'));
    }

    public function kitchen_role(Request $request){


            if(auth()->user()->role_as === 'superadmin'){
          
              $user = User::find($request->user_id);
          
              $role = $request->role;
        
              $user->role_as = $role;
                    $user->save();
                    session()->flash('type','success');
                    session()->flash('message','User role changed success');
                    return redirect()->back();
                 
          }
          
        
    }


public function send_to_kitchen(Request $request){


  $kitchen_id = $request->kitchen_id;
  $order_id = $request->order_id;

  $order = Order::find($order_id);

  $order->kitchen_id = $kitchen_id;
  $order->order_status = 'kitchen';
  $order->save();

  session()->flash('type','success');
  session()->flash('message','Order Details Send To Kitchen Panel Success.');

  return redirect()->back();

}

    //kitchen 
public function kitchen(){

  
    $infos = Kitchen::orderBy('updated_at', 'desc')->paginate(20);
 

  return view('backend.kitchen.index', compact('infos'));

   }


  public function edit_kitchen($id){
    $info = Kitchen::find($id);
    return response()->json($info);
  }

  

//Store kitchen 

public function store_kitchen(Request $request){



   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
     
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Kitchen::create([
      'name'                => $request->name,
  

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider kitchen 
public function update_kitchen(Request $request, $id){


$management = Kitchen::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',

      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
  'name'                => $request->name,

 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();
return response()->json('Updated success');
   


}

//Set kitchen id 

public function set_kitchen_id(Request $request){

    
$user_id = $request->user_id;
$kitchen_id = $request->role;


$user = User::find($user_id);

$user->kitchen_id = $kitchen_id;
$user->save();

   $this->successMessage('Settings Applied Successs.');
   return redirect()->back();

}

public function send_to_waiter(Request $request){

 

  $waiter_id = $request->waiter_id;
  $order_id = $request->order_id;

  $order = Order::find($order_id);

  $order->waiter_id = $waiter_id;
  $order->order_status = 'waiter';
  $order->save();

  session()->flash('type','success');
  session()->flash('message','Order Details Send To Waiter Panel Success.');

  return redirect()->back();



}



//Delete Slider kitchen 
public function delete_kitchen($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Kitchen::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}


    
}
