<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VatController extends Controller
{
    //vat 
public function vat(){

  
    $infos = Vat::select('code','status','id','type')->latest()->paginate(20);
 

  return view('backend.basic_settings.vat.index', compact('infos'));

   }


  public function edit_vat($id){
    $info = Vat::find($id);
    return response()->json($info);
  }

  

//Store vat 

public function store_vat(Request $request){

   $validator = Validator::make($request->all(), [
 
       'code'                => 'required|min:2',
       'type'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Vat::create([
      'code'                => $request->code,
      'type'                => $request->type,  
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider vat 
public function update_vat(Request $request, $id){

$management = Vat::find($id);

  $validator = Validator::make($request->all(), [

     
      'code'                => 'required|min:2',
      'type'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
  'code'                => $request->code,
  'type'                => $request->type,  
  'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();
return response()->json('Updated success');
   


}

//Delete Slider vat 
public function delete_vat($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Vat::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function vat_change_sts($id){
  $voucher = Vat::find($id);

 
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
