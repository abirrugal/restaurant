<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaiterController extends Controller
{
    // Waiter Items 

public function waiter_items(){

    if(auth()->user()->role_as !== 'waiter'){
    $panding_orders = Order::where('order_status', 'waiter')->paginate(20);
    return $this->sendResponse($panding_orders,'Panding Order List (Belongs to waiter panel).');

    }else{
  
      $panding_orders = Order::where('order_status', 'waiter')->where('waiter_id', auth()->user()->waiter_id)->paginate(20);
      return $this->sendResponse($panding_orders,'Panding Order List (Belongs to waiter panel).');
    }
  
  }
  
  

     //Show In Waiter User List 

     public function permited_waiter_user(){

        $user_list = User::where('role_as', 'waiter')->get();

        return $this->sendResponse($user_list,'Permited Waiter User List.');


    }


  
    // ******************Waiter Dynamic Part************


                     //Show All Dinamic created Waiter list

  public function waiter(){
  
    
      $infos = Waiter::latest()->get();
   
  
    return $this->sendResponse($infos, 'Dynamic Waiter List');
  
     }
  
  

  
  //Store waiter 
  
  public function store_waiter(Request $request){
  
     $validator = Validator::make($request->all(), [
   
         'name'                => 'required|min:2',
       
     ]);
  
     if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
  
  
  $waiter=  Waiter::create([
        'name'                => $request->name,
    
  
  ]);

  return $this->sendResponse( $waiter, 'Created success');

  
  
  }
  
  
  
  //Update  waiter 
  public function update_waiter(Request $request, $id){
  
  $management = Waiter::find($id);
  
    $validator = Validator::make($request->all(), [
  
       
        'name'                => 'required|min:2',
  
        
     ]);
  
     if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
  
   $management->update([
    'name'                => $request->name,
  
   ]);
  
   return $this->sendResponse( $management, 'Updated success');   

  
  }
  
  //Delete Slider waiter 
  public function delete_waiter($id){
  
    // if (auth()->user()->role_as !== 'creator'){
  
      $slider_img = Waiter::find($id);
  
      $slider_img->delete();
      return $this->sendResponse( [], 'Deleted success');

    // }
  
  }
  
  //Set kitchen id 
  
  public function set_waiter_id(Request $request){
  
  $user_id = $request->user_id;
  $waiter_id = $request->role;
  
  
  $user = User::find($user_id);
  
  $user->waiter_id = $waiter_id;
  $user->save();
  
  return $this->sendResponse([],'Settings Applied Successs.');   

  }
}
