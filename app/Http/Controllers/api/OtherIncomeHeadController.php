<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OtherIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherIncomeHeadController extends ApiBaseController
{
     //other_income 
public function other_income(){

  
    $infos = OtherIncome::select('name','status','id','details')->latest()->get();
 

    return $this->sendResponse($infos,'Other Income Head List.');

   }

   public function active(){
    $active_infos = OtherIncome::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Oter Income Head List.');

   }



//Store other_income 

public function store_other_income(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'details'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


$infos = OtherIncome::create([
      'name'                => $request->name,
      'details'                => $request->details,  
      'status'                => $request->status,

]);
return $this->sendResponse( $infos,'Created success');

}



//Update Slider other_income 
public function update_other_income(Request $request, $id){

$management = OtherIncome::find($id);

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

 return $this->sendResponse( $management,'Updated success');


   


}

//Delete Slider other_income 
public function delete_other_income($id){


    $slider_img = OtherIncome::find($id);

    $slider_img->delete();

    return $this->sendResponse([],'Deleted Success');


}

public function other_income_change_sts($id){
  $voucher = OtherIncome::find($id);

 
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
