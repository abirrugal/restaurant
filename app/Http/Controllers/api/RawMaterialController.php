<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Raw_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RawMaterialController extends ApiBaseController
{
     //raw_Material 
public function raw_Material(){

  
    $infos = Raw_Material::select('name','status','id','unit','use_unit','unit_use_unit','rate', 'alert_qty')->latest()->get();
 

    return $this->sendResponse($infos,'Raw Material List.');

   }


   public function active(){
    $active_infos = Raw_Material::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Raw Material List.');

   }


//Store raw_Material 

public function store_raw_Material(Request $request){

   $validator = Validator::make($request->all(), [
 
    'name'                => 'required',
    'unit'                => 'required',
    'use_unit'                => 'required',
    'unit_use_unit'                => 'required',
    'rate'                => 'required',
    'alert_qty'                => 'required',
    'status'                => 'required',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


$infos = Raw_Material::create([
      'name'                => $request->name,
      'unit'                => $request->unit,
      'use_unit'                => $request->use_unit,
      'unit_use_unit'                => $request->unit_use_unit,
      'rate'                => $request->rate,
      'alert_qty'                => $request->alert_qty,
      'status'                => $request->status,

]);
return $this->sendResponse( $infos,'Created success');



}



//Update Slider raw_Material 
public function update_raw_Material(Request $request, $id){

$management = Raw_Material::find($id);

  $validator = Validator::make($request->all(), [

    
    'name'                => 'required',
    'unit'                => 'required',
    'use_unit'                => 'required',
    'unit_use_unit'                => 'required',
    'rate'                => 'required',
    'alert_qty'                => 'required',
    'status'                => 'required',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
    'name'                => $request->name,
    'unit'                => $request->unit,
    'use_unit'                => $request->use_unit,
    'unit_use_unit'                => $request->unit_use_unit,
    'rate'                => $request->rate,
    'alert_qty'                => $request->alert_qty,
    'status'                => $request->status,
 ]);

 return $this->sendResponse( $management,'Updated success');

   


}

//Delete Slider raw_Material 
public function delete_raw_Material($id){


    $slider_img = Raw_Material::find($id);

    $slider_img->delete();
    return $this->sendResponse([],'Deleted Success');



}

public function raw_Material_change_sts($id){
  $voucher = Raw_Material::find($id);

 
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
