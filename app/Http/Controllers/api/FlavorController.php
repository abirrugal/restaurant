<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiBaseController;
use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlavorController extends ApiBaseController
{
    public function flavor(){
        
        $infos = Flavor::select('name','status','id')->latest()->get();
 
        return $this->sendResponse($infos,'Flavor List.');
}


public function active(){
  $active_infos = Flavor::where('status', 'active')->latest()->get();

  return $this->sendResponse([
   $active_infos
  ],
    
    'Active Flavor List.');

 }

//Store flavor 

public function store_flavor(Request $request){

    $validator = Validator::make($request->all(), [
  
        'name'                => 'required|min:2',
        'status'                => 'required|min:2',
    ]);
 
    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
 
 
 $flavor = Flavor::create([
       'name'                => $request->name,
       'status'                => $request->status,
 
 ]);
 

 return $this->sendResponse( $flavor,'Created success');
 
 
 }


//Update  flavor 
public function update_flavor(Request $request, $id){

    $flavor = Flavor::find($id);
    
      $validator = Validator::make($request->all(), [
    
         
          'name'                => 'required|min:2',
          'status'                => 'required|min:2',
          
       ]);
    
       if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    
   $flavor->update([
      'name'                => $request->name,
      'status'                => $request->status,
     ]);
    
     return $this->sendResponse($flavor,'Updated success');
     
   
    }


    //Delete flavor 
public function delete_flavor($id){

  
      $slider_img = Flavor::find($id);
  
     $delete_item = $slider_img->delete();
      
  
      return $this->sendResponse([],'Deleted Success');

  }

  public function flavor_change_sts($id){
    $voucher = Flavor::find($id);
  
   
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
