<?php

namespace App\Http\Controllers\backend;

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
  return view('backend.waiter.panding' , compact('panding_orders'));
  }else{

    $panding_orders = Order::where('order_status', 'waiter')->where('waiter_id', auth()->user()->waiter_id)->paginate(20);
    return view('backend.waiter.panding' , compact('panding_orders'));
  }

}


    public function waiter_list(){
        $waiter_list = Waiter::all();
        $user_list = User::where('role_as', 'waiter')->get();
        return view('backend.auth.waiter_role', compact('waiter_list','user_list'));
    }

    public function waiter_role(Request $request){


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







       //waiter 
public function waiter(){

  
    $infos = Waiter::orderBy('updated_at', 'desc')->paginate(20);
 

  return view('backend.waiter.index', compact('infos'));

   }


  public function edit_waiter($id){
    $info = Waiter::find($id);
    return response()->json($info);
  }

  

//Store waiter 

public function store_waiter(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
     
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Waiter::create([
      'name'                => $request->name,
  

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider waiter 
public function update_waiter(Request $request, $id){

$management = Waiter::find($id);

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

//Delete Slider waiter 
public function delete_waiter($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Waiter::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

//Set kitchen id 

public function set_waiter_id(Request $request){

$user_id = $request->user_id;
$waiter_id = $request->role;


$user = User::find($user_id);

$user->waiter_id = $waiter_id;
$user->save();

   $this->successMessage('Settings Applied Successs.');
   return redirect()->back();
}
}
