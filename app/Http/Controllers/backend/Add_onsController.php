<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Add_ons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Add_onsController extends Controller
{
    //add_ons 
public function add_ons(){

    

    $infos = Add_ons::select('name','status','id','price')->latest()->paginate(20);
 
  


  return view('backend.basic_settings.add_ons.index', compact('infos'));

   }


public function edit_add_ons($id){
  $info = Add_ons::findOrFail($id);
  return response()->json($info);
}

//Store add_ons 

public function store_add_ons(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
       'price'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Add_ons::create([
      'name'                => $request->name,
      'status'                => $request->status,
      'price'                => $request->price,


]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider add_ons 
public function update_add_ons(Request $request, $id){

$management = Add_ons::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'status'                => 'required|min:2',
      'price'                => 'required|min:2',

   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->name,
    'status'                => $request->status,
    'price'                => $request->price,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

   return response()->json("Success");


}

//Delete Slider add_ons 
public function delete_add_ons($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Add_ons::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function add_ons_change_sts($id){
  $voucher = Add_ons::find($id);

 
  if ($voucher->status == "Active") {
   
    $voucher->status = "Inactive";
    $voucher->save();
  }else{

    
    $voucher->status = "Active";
    $voucher->save();
  }
  

  $this->successMessage('Status Changed Success');
  return redirect()->back();
}
}
