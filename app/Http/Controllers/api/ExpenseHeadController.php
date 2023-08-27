<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Expense_Head;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseHeadController extends ApiBaseController
{
      //expense_Head 
public function expense_Head(){

    

    $infos = Expense_Head::select('name','status','id','type','amount','details')->latest()->paginate(20);
  


    return $this->sendResponse($infos,'Expense Head List.');

   }



   public function active(){
    $active_infos = Expense_Head::where('status', 'active')->latest()->get();

    return $this->sendResponse([
     $active_infos
    ],
      
      'Active Expense Head List.');

   }


//Store expense_Head 

public function store_expense_Head(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'type'                => 'required|min:2',
       'amount'                => 'required',
       'details'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }


   $infos = Expense_Head::create([
      'name'                => $request->name,
      'type'                => $request->type,
      'amount'                => $request->amount,
      'details'                => $request->details,
      'status'                => $request->status,

]);
return $this->sendResponse($infos,'Created Success.');



}



//Update Slider expense_Head 
public function update_expense_Head(Request $request, $id){

$management = Expense_Head::find($id);

  $validator = Validator::make($request->all(), [

     
    'name'                => 'required|min:2',
    'type'                => 'required|min:2',
    'amount'                => 'required',
    'details'                => 'required|min:2',
    'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

 $management->update([
    'name'                => $request->name,
    'type'                => $request->type,
    'amount'                => $request->amount,
    'details'                => $request->details,
    'status'                => $request->status,
 ]);



  return $this->sendResponse($management,'Updated Success.');

   


}

//Delete Slider expense_Head 
public function delete_expense_Head($id){


    $slider_img = Expense_Head::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');

    return $this->sendResponse([],'Deleted Success');


}

public function expense_Head_change_sts($id){
  $voucher = Expense_Head::find($id);

 
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
