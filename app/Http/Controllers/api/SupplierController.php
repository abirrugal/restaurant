<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends ApiBaseController
{
      //supplier 
public function supplier(){

  
    $infos = supplier::select('name','status','id','number','address','balance')->latest()->get();
 

    return $this->sendResponse($infos,'Vat List.');

   }


   public function active(){
    $active_infos = supplier::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Supplier List.');

   }



//Store supplier 

public function store_supplier(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'number'                => 'required|min:2',
       'address'                => 'required|min:2',
       'balance'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


   $infos =supplier::create([
      'name'                => $request->name,
      'number'                => $request->number,
      'address'                => $request->address,
      'balance'                => $request->balance,
      'status'                => $request->status,

]);
return $this->sendResponse( $infos,'Created success');



}



//Update Slider supplier 
public function update_supplier(Request $request, $id){

$management = supplier::find($id);

  $validator = Validator::make($request->all(), [

     
    'name'                => 'required|min:2',
    'number'                => 'required|min:2',
    'address'                => 'required|min:2',
    'balance'                => 'required|min:2',
    'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
    'name'                => $request->name,
    'number'                => $request->number,
    'address'                => $request->address,
    'balance'                => $request->balance,
    'status'                => $request->status,
 ]);

 return $this->sendResponse( $management,'Updated success');



}

//Delete Slider supplier 
public function delete_supplier($id){


    $slider_img = supplier::find($id);

    $slider_img->delete();
    return $this->sendResponse([],'Deleted Success');


}

public function supplier_change_sts($id){
  $voucher = supplier::find($id);

 
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
