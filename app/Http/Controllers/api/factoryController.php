<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class factoryController extends ApiBaseController
{
     //factory 
public function factory(){

  
    $infos = factory::select('name','status','id','address','balance')->latest()->get();
 

    return $this->sendResponse($infos,'Factory List.');

   }

   public function active(){
    $active_infos = factory::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Factory List.');

   }



//Store factory 

public function store_factory(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'address'                => 'required|min:2',
       'balance'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


$infos = factory::create([
      'name'                => $request->name,
      'address'                => $request->address,
      'balance'                => $request->balance,
      'status'                => $request->status,

]);

return $this->sendResponse($infos,'Created Success.');



}



//Update Slider factory 
public function update_factory(Request $request, $id){

$management = factory::find($id);

  $validator = Validator::make($request->all(), [

     
    'name'                => 'required|min:2',
    'address'                => 'required|min:2',
    'balance'                => 'required|min:2',
    'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
    'name'                => $request->name,
    'address'                => $request->address,
    'balance'                => $request->balance,
    'status'                => $request->status,
 ]);



 return $this->sendResponse($management,'Updated Success.');


}

//Delete Slider factory 
public function delete_factory($id){


    $slider_img = factory::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
 
    return $this->sendResponse([],'Deleted Success');


}

public function factory_change_sts($id){
  $voucher = factory::find($id);

 
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
