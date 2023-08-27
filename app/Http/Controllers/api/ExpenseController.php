<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Expense_Head;
use App\Models\Expenses_Type;
use App\Models\Fund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends ApiBaseController
{
     //expense 
public function expense(){

  
    $infos = Expense::select('id','type','head_type','fund','amount','date','note')->latest()->get();
    // $expenses_type = Expenses_Type::where('status','active')->select('name')->get();
    // $expenses_head_type = Expense_Head::where('status','active')->select('name')->get();
    // $expenses_fund = Fund::where('status','active')->select('name')->get();

    return $this->sendResponse(
      [
   $infos, 
      // 'expenses_type' => $expenses_type, 
      // 'expenses_head' => $expenses_head_type,
      // 'expenses_fund' => $expenses_fund,
    ],
      
      'Expense List.');

   }





//Store expense 

public function store_expense(Request $request){

   $validator = Validator::make($request->all(), [
 
       'type'                => 'required|min:2',
       'head_type'                => 'required|min:2',
       'fund'                => 'required|min:2',
       'amount'                => 'required|min:2',
       'date'                => 'required|min:2',
       'note'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
  }


   $date =Carbon::parse($request->date)
   ->toDateTimeString();



$expense = Expense::create([
      'type'                => $request->type,
      'head_type'                => $request->head_type,
      'fund'                => $request->fund,
      'amount'                => $request->amount,
      'date'                => $date,
      'note'                => $request->note,

]);


return $this->sendResponse( $expense, 'Created success');



}



//Update Slider expense 
public function update_expense(Request $request, $id){

$expense = Expense::find($id);

  $validator = Validator::make($request->all(), [

     
    'type'                => 'required|min:2',
    'head_type'                => 'required|min:2',
    'fund'                => 'required|min:2',
    'amount'                => 'required|min:2',
    'date'                => 'required|min:2',
    'note'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
  }

   $date =Carbon::parse($request->date)
   ->toDateTimeString();

 $expense->update([
    'type'                => $request->type,
    'head_type'                => $request->head_type,
    'fund'                => $request->fund,
    'amount'                => $request->amount,
    'date'                => $date,
    'note'                => $request->note,
 ]);



 return $this->sendResponse( $expense, 'Updated success');



}

//Delete Slider expense 
public function delete_expense($id){


    $slider_img = Expense::find($id);

    $slider_img->delete();

    return $this->sendResponse([],'Deleted Success');
  
}

public function expense_change_sts($id){
  $voucher = Expense::find($id);

 
  if ($voucher->status == "Active") {
   
    $voucher->status = "Inactive";
    $voucher->save();
  }else{

    
    $voucher->status = "Active";
    $voucher->save();
  }
  

  $status = $voucher->status;
    
  return $this->sendResponse([], 'Status Changed To ' . $status . ' Success');
}


public function expense_info_filter(Request $request){

  $start_date = Carbon::parse($request->start_date)
  ->toDateTimeString();

  $end_date = Carbon::parse($request->end_date)
  ->toDateTimeString();


  $infos = Expense::whereBetween('date', [$start_date,$end_date])->paginate(20);


  return $this->sendResponse( $infos, 'Search Results.');


}
}
