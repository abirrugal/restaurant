<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMatAmount;
use App\Models\ProductMatSetting;
use App\Models\Raw_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productMaterialSettingsController extends Controller
{
    //product_mat_setting 
public function product_mat_setting(){

  
    $infos = ProductMatSetting::with('amounts')->latest()->paginate(20);
    $products = Product::where('status','active')->select('name')->get();
    $raw_materials = Raw_Material::where('status','active')->get();


  return view('backend.basic_settings.product_mat_setting.index', compact('infos','products','raw_materials'));

   }


//Store product_mat_setting 

public function store_product_mat_setting(Request $request){

    // dd($request->amount[0]);
    

   $validator = Validator::make($request->all(), [
 
       'pro_name'                => 'required',
       'mat_name'                => 'required',
       'unit'                => 'required',
       'status'                => 'required',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


  $product_mat_setting =  ProductMatSetting::create([
      'name'                => $request->pro_name,
      'status'                => $request->status,
      

]);




foreach ($request->unit as $key => $value) {

  

if($request->amount[$key] !== null){
    $product_mat_setting->amounts()->create([
        'product_mat_setting_id'  => $product_mat_setting->id,
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
  }



   $this->successMessage('Created success');
   return redirect()->back();



}

public function edit_product_mat_setting($id){

   

  $info = ProductMatSetting::find($id);
  $products = Product::where('status','active')->select('name')->get();
  $raw_materials = Raw_Material::where('status','active')->get();

  return view('backend.basic_settings.product_mat_setting.edit', compact('info','products','raw_materials'));

}


//Update Slider product_mat_setting 
public function update_product_mat_setting(Request $request, $id){


$management = ProductMatSetting::find($id);

  $validator = Validator::make($request->all(), [

     
    'pro_name'                => 'required',
    'mat_name'                => 'required',
    'unit'                => 'required',
    'status'                => 'required',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->pro_name,
    'status'                => $request->status,
 ]);





foreach ($management->amounts as $key => $value) {


   $info = ProductMatAmount::find($value->id);

$info->delete();

}


foreach ($request->unit as $key => $value) {

  

  if($request->amount[$key] !== null){
    $management->amounts()->create([
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
    
    }



  $this->successMessage('Updated Success');
  return redirect()->back();
   


}

//Delete Slider product_mat_setting 
public function delete_product_mat_setting($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = ProductMatSetting::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function product_mat_setting_change_sts($id){
  $voucher = ProductMatSetting::find($id);

 
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
