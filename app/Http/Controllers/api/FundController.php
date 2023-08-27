<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundController extends ApiBaseController
{
     //fund 
public function fund(){

  
    $infos = Fund::select('name','status','id','details')->latest()->get();
 

    return $this->sendResponse($infos,'Fund List.');

   }

   public function active(){
    $active_infos = Fund::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Fund List.');

   }



//Store fund 

public function store_fund(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'details'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
}


$fund = Fund::create([
      'name'                => $request->name,
      'details'                => $request->details,  
      'status'                => $request->status,

]);
return $this->sendResponse( $fund, 'Created success');



}



//Update Slider fund 
public function update_fund(Request $request, $id){

$management = Fund::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'details'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
  'name'                => $request->name,
  'details'                => $request->details,
  'status'                => $request->status,
 ]);

 

 return $this->sendResponse( $management, 'Updated success');


}

//Delete Slider fund 
public function delete_fund($id){


    $slider_img = Fund::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');

    return $this->sendResponse( [], 'Deleted success');

 

}

public function fund_change_sts($id){
  $voucher = Fund::find($id);

 
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
