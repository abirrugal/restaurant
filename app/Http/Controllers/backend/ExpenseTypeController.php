<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Expenses_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseTypeController extends Controller
{
      //expense_type 
public function expense_type(){

  
    $infos = Expenses_Type::select('name','status','id','details')->latest()->paginate(20);
 

  return view('backend.basic_settings.expense_type.index', compact('infos'));

   }

 public function  edit_expense_type($id){

  $info = Expenses_Type::findOrFail($id);
  return response()->json($info);
 }


//Store expense_type 

public function store_expense_type(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Expenses_Type::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


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
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
  'name'                => $request->name,
  'details'                => $request->details,
  'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

return response()->json("success");   


}

//Delete Slider expense_type 
public function delete_expense_type($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Expenses_Type::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
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
  

  $this->successMessage('Status Changed Success');
  return redirect()->back();
}
}
