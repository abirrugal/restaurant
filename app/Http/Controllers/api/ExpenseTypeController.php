<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Expenses_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseTypeController extends ApiBaseController
{
      //expense_type 
public function expense_type(){

  
    $infos = Expenses_Type::select('name','status','id','details')->latest()->get();
 

    return $this->sendResponse($infos,'Expense Type List.');

   }

   public function active(){
    $active_infos = Expenses_Type::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Expense Type List.');

   }


//Store expense_type 

public function store_expense_type(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
}


$infos = Expenses_Type::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);
return $this->sendResponse($infos,'Created Success.');



}



//Update Slider expense_type 
public function update_expense_type(Request $request, $id){

$management = Expenses_Type::find($id);

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



  return $this->sendResponse($management,'Updated Success.');


}

//Delete Slider expense_type 
public function delete_expense_type($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Expenses_Type::find($id);

    $slider_img->delete();
    return $this->sendResponse([],'Deleted Success');

  // }

}

public function expense_type_change_sts($id){
  $voucher = Expenses_Type::find($id);

 
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
