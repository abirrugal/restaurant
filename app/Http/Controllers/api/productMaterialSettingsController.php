<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductMatAmount;
use App\Models\ProductMatSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productMaterialSettingsController extends ApiBaseController
{
     //product_mat_setting 
public function product_mat_setting(){

  
    $infos = ProductMatSetting::with('amounts')->latest()->get();

    return $this->sendResponse($infos,'Product Material Settings List.');

   }


//Store product_mat_setting 

public function store_product_mat_setting(Request $request){

    // dd($request->amount[0]);
    

   $validator = Validator::make($request->all(), [
 
       'pro_name'                => 'required',
       'mat_name'                => 'required',
       'unit'                => 'required',
       'status'                => 'required',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


  $product_mat_setting =  ProductMatSetting::create([
      'name'                => $request->pro_name,
      'status'                => $request->status,
      

]);




foreach ($request->unit as $key => $value) {

  

if($request->amount[$key] !== null){
    $product_mat_setting->amounts()->create([
        'product_mat_setting_id'  => $product_mat_setting->id,
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
  }


  return $this->sendResponse( [], 'Created success');

}




//Update Slider product_mat_setting 
public function update_product_mat_setting(Request $request, $id){


$management = ProductMatSetting::find($id);

  $validator = Validator::make($request->all(), [

     
    'pro_name'                => 'required',
    'mat_name'                => 'required',
    'unit'                => 'required',
    'status'                => 'required',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
    'name'                => $request->pro_name,
    'status'                => $request->status,
 ]);



foreach ($management->amounts as $key => $value) {


   $info = ProductMatAmount::find($value->id);

$info->delete();

}


foreach ($request->unit as $key => $value) {

  

  if($request->amount[$key] !== null){
    $management->amounts()->create([
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
    
    }



    return $this->sendResponse( $management, 'Updated success');

   


}

//Delete Slider product_mat_setting 
public function delete_product_mat_setting($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = ProductMatSetting::find($id);

    $slider_img->delete();
    return $this->sendResponse( [], 'Deleted success');

  // }

}

public function product_mat_setting_change_sts($id){
  $voucher = ProductMatSetting::find($id);

 
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
