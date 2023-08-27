<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundController extends Controller
{
    //fund 
public function fund(){

  
    $infos = Fund::select('name','status','id','details')->latest()->paginate(20);
 

  return view('backend.basic_settings.fund.index', compact('infos'));

   }


   public function edit_fund($id){
     $info = Fund::find($id);
     return response()->json($info);
   }
//Store fund 

public function store_fund(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'details'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Fund::create([
      'name'                => $request->name,
      'details'                => $request->details,  
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider fund 
public function update_fund(Request $request, $id){

$management = Fund::find($id);

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

   return response()->json('Success');


}

//Delete Slider fund 
public function delete_fund($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Fund::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function fund_change_sts($id){
  $voucher = Fund::find($id);

 
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
