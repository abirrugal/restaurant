<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Add_ons;
use App\Models\AddOnsMaterialAmount;
use App\Models\AddOnsMaterialSetting;
use App\Models\Raw_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddOnsMaterialSettingController extends ApiBaseController
{
     //add_ons_mat_setting 
public function add_ons_mat_setting(){

  
    $infos = AddOnsMaterialSetting::with('add_amounts')->latest()->get();
    $add_amounts = [];

   foreach ($infos as  $info) {
     foreach ($info->add_amounts as $item) {
        
        array_push($add_amounts, [
            'material_name' => $item->material_name,
            'amount' => $item->amount,
            'unit' => $item->unit,
        ]);

     }
   }


   return $this->sendResponse(
    [
    'created_add_one_name'=> $infos, 
    'created_add_one_infos' => $add_amounts,
    
  ],
    
    'Add Ons Material Settings List (Created_add_one_name). ');
   }


//Store add_ons_mat_setting 

public function store_add_ons_mat_setting(Request $request){

    // dd($request->amount[0]);
    

   $validator = Validator::make($request->all(), [
 
       'pro_name'                => 'required',
       'mat_name'                => 'required',
       'unit'                => 'required',
       'status'                => 'required',
   ]);

   if($validator->fails()){
    return $this->sendError("Validation Error." , $validator->errors());
  }





  $add_ons_mat_setting =  AddOnsMaterialSetting::create([
      'name'                => $request->pro_name,
      'status'                => $request->status,
      

]);




foreach ($request->unit as $key => $value) {

  

if($request->amount[$key] !== null){
    $add_ons_mat_setting->add_amounts()->create([
        'add_ons_mat_setting_id'  => $add_ons_mat_setting->id,
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
  }



  return $this->sendResponse($add_ons_mat_setting,'Created Success');




}




//Update Slider add_ons_mat_setting 
public function update_add_ons_mat_setting(Request $request, $id){


$management = AddOnsMaterialSetting::find($id);

  $validator = Validator::make($request->all(), [

     
    'pro_name'                => 'required',
    'mat_name'                => 'required',
    'unit'                => 'required',
    'status'                => 'required',
      
   ]);

   if($validator->fails()){
    return $this->sendError("Validation Error." , $validator->errors());
  }

 $management->update([
    'name'                => $request->pro_name,
    'status'                => $request->status,
 ]);





foreach ($management->add_amounts as $key => $value) {


   $info = AddOnsMaterialAmount::find($value->id);

$info->delete();

}


foreach ($request->unit as $key => $value) {

  

  if($request->amount[$key] !== null){
    $management->add_amounts()->create([
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
    
    }



    return $this->sendResponse($management, 'Updated Success.');

   


}

//Delete Slider add_ons_mat_setting 
public function delete_add_ons_mat_setting($id){


    $slider_img = AddOnsMaterialSetting::find($id);

    $slider_img->delete();

    return $this->sendResponse([], 'Deleted Success.');

}

public function add_ons_mat_setting_change_sts($id){
  $voucher = AddOnsMaterialSetting::find($id);

 
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
