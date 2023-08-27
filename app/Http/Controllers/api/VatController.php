<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VatController extends ApiBaseController
{
    //vat 
public function vat(){

  
    $infos = Vat::select('code','status','id','type')->latest()->get();
 

    return $this->sendResponse($infos,'Vat List.');

   }

   public function active(){
    $active_infos = Vat::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Vat List.');

   }

//Store vat 

public function store_vat(Request $request){

   $validator = Validator::make($request->all(), [
 
       'code'                => 'required|min:2',
       'type'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
}


$infos = Vat::create([
      'code'                => $request->code,
      'type'                => $request->type,  
      'status'                => $request->status,

]);
return $this->sendResponse( $infos,'Created success');



}



//Update Slider vat 
public function update_vat(Request $request, $id){

$management = Vat::find($id);

  $validator = Validator::make($request->all(), [

     
      'code'                => 'required|min:2',
      'type'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
  'code'                => $request->code,
  'type'                => $request->type,  
  'status'                => $request->status,
 ]);


 return $this->sendResponse( $management,'Updated success');
   


}

//Delete Slider vat 
public function delete_vat($id){


    $slider_img = Vat::find($id);

    $slider_img->delete();

    return $this->sendResponse([],'Deleted Success');



}

public function vat_change_sts($id){
  $voucher = Vat::find($id);

 
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
