<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Add_ons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Add_onsController extends ApiBaseController
{
    //add_ons 
public function add_ons(){

    

    $infos = Add_ons::select('name','status','id','price')->latest()->get();
 

    return $this->sendResponse($infos,'Add Ons List.');

    

   }


   public function active(){
    $active_infos = Add_ons::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Add Ons List.');

   }


//Store add_ons 

public function store_add_ons(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
       'price'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
}


$add_ons = Add_ons::create([
      'name'                => $request->name,
      'status'                => $request->status,
      'price'                => $request->price,


]);
return $this->sendResponse( $add_ons, 'Created success');

}



//Update Slider add_ons 
public function update_add_ons(Request $request, $id){

$add_ons = Add_ons::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'status'                => 'required|min:2',
      'price'                => 'required|min:2',

   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $add_ons->update([
    'name'                => $request->name,
    'status'                => $request->status,
    'price'                => $request->price,
 ]);



 return $this->sendResponse( $add_ons, 'Updated success');


}

//Delete Slider add_ons 
public function delete_add_ons($id){


    $slider_img = Add_ons::find($id);

    $slider_img->delete();

    return $this->sendResponse([],'Deleted Success');


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
  

  $status = $voucher->status;
    
  return $this->sendResponse($status, 'Status Changed To ' . $status . ' Success');
}
}
