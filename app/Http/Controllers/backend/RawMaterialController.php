<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Raw_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RawMaterialController extends Controller
{
    //raw_Material 
public function raw_Material(){

  
    $infos = Raw_Material::select('name','status','id','unit','use_unit','unit_use_unit','rate', 'alert_qty')->latest()->paginate(20);
 

  return view('backend.basic_settings.raw_Material.index', compact('infos'));

   }

   public function edit_raw_material($id){
     $info = Raw_Material::find($id);
     return response()->json($info);
   }

//Store raw_Material 

public function store_raw_Material(Request $request){

   $validator = Validator::make($request->all(), [
 
    'name'                => 'required',
    'unit'                => 'required',
    'use_unit'                => 'required',
    'unit_use_unit'                => 'required',
    'rate'                => 'required',
    'alert_qty'                => 'required',
    'status'                => 'required',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Raw_Material::create([
      'name'                => $request->name,
      'unit'                => $request->unit,
      'use_unit'                => $request->use_unit,
      'unit_use_unit'                => $request->unit_use_unit,
      'rate'                => $request->rate,
      'alert_qty'                => $request->alert_qty,
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider raw_Material 
public function update_raw_Material(Request $request, $id){

$management = Raw_Material::find($id);

  $validator = Validator::make($request->all(), [

    
    'name'                => 'required',
    'unit'                => 'required',
    'use_unit'                => 'required',
    'unit_use_unit'                => 'required',
    'rate'                => 'required',
    'alert_qty'                => 'required',
    'status'                => 'required',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->name,
    'unit'                => $request->unit,
    'use_unit'                => $request->use_unit,
    'unit_use_unit'                => $request->unit_use_unit,
    'rate'                => $request->rate,
    'alert_qty'                => $request->alert_qty,
    'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

  return response()->json('Success');
   


}

//Delete Slider raw_Material 
public function delete_raw_Material($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Raw_Material::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function raw_Material_change_sts($id){
  $voucher = Raw_Material::find($id);

 
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
