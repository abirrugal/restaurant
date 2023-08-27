<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Expense_Head;
use App\Models\Expenses_Type;
use App\Models\Fund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    //expense 
public function expense(){

  
    $infos = Expense::select('id','type','head_type','fund','amount','date','note')->latest()->paginate(20);
    $expenses_type = Expenses_Type::where('status','active')->select('name')->get();
    $expenses_head_type = Expense_Head::where('status','active')->select('name')->get();
    $expenses_fund = Fund::where('status','active')->select('name')->get();

  return view('backend.accounts.expense.index', compact('infos','expenses_type','expenses_head_type','expenses_fund'));

   }

   public function edit_expense($id){

     $info = Expense::find($id);
     return response()->json($info);
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
       return redirect()->back()->withErrors($validator)->withInput();
   }


   $date =Carbon::parse($request->date)
   ->toDateTimeString();



Expense::create([
      'type'                => $request->type,
      'head_type'                => $request->head_type,
      'fund'                => $request->fund,
      'amount'                => $request->amount,
      'date'                => $date,
      'note'                => $request->note,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider expense 
public function update_expense(Request $request, $id){

$management = Expense::find($id);

  $validator = Validator::make($request->all(), [

     
    'type'                => 'required|min:2',
    'head_type'                => 'required|min:2',
    'fund'                => 'required|min:2',
    'amount'                => 'required|min:2',
    'date'                => 'required|min:2',
    'note'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

   $date =Carbon::parse($request->date)
   ->toDateTimeString();

 $management->update([
    'type'                => $request->type,
    'head_type'                => $request->head_type,
    'fund'                => $request->fund,
    'amount'                => $request->amount,
    'date'                => $date,
    'note'                => $request->note,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

  return response()->json('Updated success');



}

//Delete Slider expense 
public function delete_expense($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Expense::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

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
  

  $this->successMessage('Status Changed Success');
  return redirect()->back();
}

public function expense_info_filter(Request $request){

  $start_date = Carbon::parse($request->start_date)
  ->toDateTimeString();

  $end_date = Carbon::parse($request->end_date)
  ->toDateTimeString();


  $infos = Expense::whereBetween('date', [$start_date,$end_date])->paginate(20);


  $expense_sum = Expense::whereBetween('date', [$start_date,$end_date])->sum('amount');

  $expenses_type = Expenses_Type::where('status','active')->select('name')->get();
  $expenses_head_type = Expense_Head::where('status','active')->select('name')->get();
  $expenses_fund = Fund::where('status','active')->select('name')->get();

  return view('backend.accounts.expense.index', compact('infos','expense_sum','expenses_type', 'expenses_head_type', 'expenses_fund'));


}
}
