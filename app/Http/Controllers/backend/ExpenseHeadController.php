<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Expense_Head;
use App\Models\Expenses_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseHeadController extends Controller
{
     //expense_Head 
public function expense_Head(){

    

    $infos = Expense_Head::select('name','status','id','type','amount','details')->latest()->paginate(20);
    $expenses_type = Expenses_Type::select('name')->get();
  


  return view('backend.basic_settings.expense_Head.index', compact('infos','expenses_type'));

   }

   public function edit_expense_head($id){
     $info = Expense_Head::find($id);
     return response()->json($info);
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
       return redirect()->back()->withErrors($validator)->withInput();
   }


Expense_Head::create([
      'name'                => $request->name,
      'type'                => $request->type,
      'amount'                => $request->amount,
      'details'                => $request->details,
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


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
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->name,
    'type'                => $request->type,
    'amount'                => $request->amount,
    'details'                => $request->details,
    'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

  return response()->json("Success");

   


}

//Delete Slider expense_Head 
public function delete_expense_Head($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Expense_Head::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

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
  

  $this->successMessage('Status Changed Success');
  return redirect()->back();
}
}
