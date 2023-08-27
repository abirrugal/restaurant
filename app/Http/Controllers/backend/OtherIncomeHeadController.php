<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OtherIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherIncomeHeadController extends Controller
{
     //other_income 
public function other_income(){

  
    $infos = OtherIncome::select('name','status','id','details')->latest()->paginate(20);
 

  return view('backend.basic_settings.other_income.index', compact('infos'));

   }

   public function edit_other_income($id){
     $info = OtherIncome::findOrFail($id);
     return response()->json($info);
   }


//Store other_income 

public function store_other_income(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'details'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


OtherIncome::create([
      'name'                => $request->name,
      'details'                => $request->details,  
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider other_income 
public function update_other_income(Request $request, $id){

$management = OtherIncome::find($id);

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

//Delete Slider other_income 
public function delete_other_income($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = OtherIncome::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function other_income_change_sts($id){
  $voucher = OtherIncome::find($id);

 
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
