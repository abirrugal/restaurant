<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KitchenController extends ApiBaseController
{


    // Kitchen Items 

public function kitchen_items(){

    if(auth()->user()->role_as !== 'kitchen'){
    //   $waiters = Waiter::all();
    $panding_orders = Order::where('order_status', 'kitchen')->paginate(20);

    return $this->sendResponse($panding_orders,'Panding Order List (Belongs to kitchen panel).');
}else{

    // $waiters = Waiter::all();
    $panding_orders = Order::where('order_status', 'kitchen')->where('kitchen_id', auth()->user()->kitchen_id)->paginate(20);
    return $this->sendResponse($panding_orders,'Panding Order List (Belongs to kitchen panel).');
  }
  
  
  }






    //Show In Kitchen User List 

    public function permited_kitchen_user(){

        $user_list = User::where('role_as', 'kitchen')->get();

        return $this->sendResponse($user_list,'Permited Kitchen User List.');


    }



    //Send Kitchen Items to Waiter
    
    public function send_to_waiter(Request $request){

        $waiter_id = $request->waiter_id;
        $order_id = $request->order_id;
      
        $order = Order::find($order_id);
      
        $order->waiter_id = $waiter_id;
        $order->order_status = 'waiter';
        $order->save();
      


        return $this->sendResponse([],'Order Details Send To Waiter Panel Success.');

      
      
      }


//Change Role As Kitchen (Set kitchen from create user -> user list)

    public function kitchen_role(Request $request){


            // if(auth()->user()->role_as === 'superadmin'){
          
              $user = User::find($request->user_id);
          
              $role = $request->role;
        
              $user->role_as = $role;
                    $user->save();
                
                    
  $role = $user->role_as;
    
  return $this->sendResponse($role, 'Status Changed To ' . $role . ' Success');
                 
        //   }
          
        
    }


public function send_to_kitchen(Request $request){


  $kitchen_id = $request->kitchen_id;
  $order_id = $request->order_id;

  $order = Order::find($order_id);

  $order->kitchen_id = $kitchen_id;
  $order->order_status = 'kitchen';
  $order->save();


  return $this->sendResponse([], 'Order Details Send To Kitchen Panel Success.');


}

    // ****************** Kitchen Dynamic Part ************


 //Show All Dinamic created Kitchen list

public function kitchen(){

  
    $infos = Kitchen::latest()->get();
 

    return $this->sendResponse($infos, 'Dynamic Kitchen List');

   }




//Store kitchen 

public function store_kitchen(Request $request){



   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
     
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


$kitchen = Kitchen::create([
      'name'                => $request->name,
  

]);

return $this->sendResponse( $kitchen, 'Created success');



}



//Update  kitchen 
public function update_kitchen(Request $request, $id){


$management = Kitchen::find($id);

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

//Delete Slider kitchen 
public function delete_kitchen($id){


    $slider_img = Kitchen::find($id);

    $slider_img->delete();
  
    return $this->sendResponse( [], 'Deleted success');


}




//Set Kitchen id to user->kitchen_id decide which kitchen can control

public function set_kitchen_id(Request $request){

    
$user_id = $request->user_id;
$kitchen_id = $request->role;


$user = User::find($user_id);

$user->kitchen_id = $kitchen_id;
$user->save();

   return $this->sendResponse([],'Settings Applied Successs.');   

}




}
