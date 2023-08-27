<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CounterController extends ApiBaseController
{
     //counter 
public function counter(){

  
    $infos = Counter::select('name','status','id')->latest()->get();
 

    return $this->sendResponse($infos,'Counter List.');


   }


   public function active(){
    $active_infos = Counter::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Counter List.');

   }


//Store counter 

public function store_counter(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
}


$counter = Counter::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);

return $this->sendResponse( $counter,'Created success');



}



//Update Slider counter 
public function update_counter(Request $request, $id){

$counter = Counter::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $counter->update([
  'name'                => $request->name,
  'status'                => $request->status,
 ]);

 return $this->sendResponse( $counter,'Created success');



}

//Delete Slider counter 
public function delete_counter($id){

    $slider_img = Counter::find($id);

    $slider_img->delete();

    return $this->sendResponse( [] ,'Deleted success');

}

public function counter_change_sts($id){
  $counter = Counter::find($id);

 
  if ($counter->status == "Active") {
   
    $counter->status = "Inactive";
    $counter->save();
  }else{

    
    $counter->status = "Active";
    $counter->save();
  }
  
  $status = $counter->status;

  return $this->sendResponse($status, 'Status Changed To ' . $status . ' Success');


}
}
