<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chocolate_flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChocolateFlavorController extends ApiBaseController
{
      //chocolate_flavor 
public function chocolate_flavor(){

    

    $all_infos = Chocolate_flavor::latest()->get();
 

  return $this->sendResponse([
    'all_choco'=>$all_infos,
  ],
    
  'Chocolate Flavor List.');

   }

   public function active(){
    $active_infos = Chocolate_flavor::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Chocolate Flavor List.');

   }

  //  public



//Store chocolate_flavor 

public function store_chocolate_flavor(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return $this->sendError("Validation Error." , $validator->errors());
   }


$data = Chocolate_flavor::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);

return $this->sendResponse($data,'Created Success');



}



//Update Slider chocolate_flavor 
public function update_chocolate_flavor(Request $request, $id){

$chocolate_flavor = Chocolate_flavor::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return $this->sendError('Validation Error.', $validator->errors());
   }

 $chocolate_flavor->update([
  'name'                => $request->name,
  'status'                => $request->status,
 ]);

 return $this->sendResponse($chocolate_flavor, 'Updated Success.');



}

//Delete  chocolate_flavor 
public function delete_chocolate_flavor($id){


    $slider_img = Chocolate_flavor::find($id);

    $slider_img->delete();
   
    return $this->sendResponse([], 'Deleted Success.');


}

public function chocolate_flavor_change_sts($id){
  $voucher = Chocolate_flavor::find($id);

 
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
