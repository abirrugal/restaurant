<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class supplierController extends Controller
{
          //supplier 
public function supplier(){

  
    $infos = supplier::select('name','status','id','number','address','balance')->latest()->paginate(20);
 

  return view('backend.other_settings.supplier.index', compact('infos'));

   }

 public function  edit_supplier($id){

  $info = supplier::findOrFail($id);
  return response()->json($info);
 }


//Store supplier 

public function store_supplier(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'number'                => 'required|min:2',
       'address'                => 'required|min:2',
       'balance'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


supplier::create([
      'name'                => $request->name,
      'number'                => $request->number,
      'address'                => $request->address,
      'balance'                => $request->balance,
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider supplier 
public function update_supplier(Request $request, $id){

$management = supplier::find($id);

  $validator = Validator::make($request->all(), [

     
    'name'                => 'required|min:2',
    'number'                => 'required|min:2',
    'address'                => 'required|min:2',
    'balance'                => 'required|min:2',
    'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->name,
    'number'                => $request->number,
    'address'                => $request->address,
    'balance'                => $request->balance,
    'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

return response()->json("success");   


}

//Delete Slider supplier 
public function delete_supplier($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = supplier::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function supplier_change_sts($id){
  $voucher = supplier::find($id);

 
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
