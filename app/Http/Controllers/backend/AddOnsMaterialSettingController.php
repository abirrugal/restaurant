<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Add_ons;
use App\Models\AddOnsMaterialAmount;
use App\Models\AddOnsMaterialSetting;
use App\Models\Raw_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddOnsMaterialSettingController extends Controller
{
   //add_ons_mat_setting 
public function add_ons_mat_setting(){

  
    $infos = AddOnsMaterialSetting::with('add_amounts')->latest()->paginate(20);
    $products = Add_ons::where('status','active')->select('name')->get();
    $raw_materials = Raw_Material::where('status','active')->get();


  return view('backend.basic_settings.add_ons_mat_setting.index', compact('infos','products','raw_materials'));

   }


//Store add_ons_mat_setting 

public function store_add_ons_mat_setting(Request $request){

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


  $add_ons_mat_setting =  AddOnsMaterialSetting::create([
      'name'                => $request->pro_name,
      'status'                => $request->status,
      

]);




foreach ($request->unit as $key => $value) {

  

if($request->amount[$key] !== null){
    $add_ons_mat_setting->add_amounts()->create([
        'add_ons_mat_setting_id'  => $add_ons_mat_setting->id,
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
  }



   $this->successMessage('Created success');
   return redirect()->back();



}

public function edit_add_ons_mat_setting($id){

   

  $info = AddOnsMaterialSetting::find($id);
  $products = Add_ons::where('status','active')->select('name')->get();
  $raw_materials = Raw_Material::where('status','active')->get();

  return view('backend.basic_settings.add_ons_mat_setting.edit', compact('info','products','raw_materials'));

}


//Update Slider add_ons_mat_setting 
public function update_add_ons_mat_setting(Request $request, $id){


$management = AddOnsMaterialSetting::find($id);

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





foreach ($management->add_amounts as $key => $value) {


   $info = AddOnsMaterialAmount::find($value->id);

$info->delete();

}


foreach ($request->unit as $key => $value) {

  

  if($request->amount[$key] !== null){
    $management->add_amounts()->create([
        'material_name' => $request->mat_name[$key],
        'amount'        => $request->amount[$key],
        'unit'          => $request->unit[$key],
    ]);
  }
    
    }



  $this->successMessage('Updated Success');
  return redirect()->back();
   


}

//Delete Slider add_ons_mat_setting 
public function delete_add_ons_mat_setting($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = AddOnsMaterialSetting::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function add_ons_mat_setting_change_sts($id){
  $voucher = AddOnsMaterialSetting::find($id);

 
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
