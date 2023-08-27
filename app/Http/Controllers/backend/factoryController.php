<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class factoryController extends Controller
{
     //factory 
public function factory(){

  
    $infos = factory::select('name','status','id','address','balance')->latest()->paginate(20);
 

  return view('backend.other_settings.factory.index', compact('infos'));

   }

 public function  edit_factory($id){

  $info = factory::findOrFail($id);
  return response()->json($info);
 }


//Store factory 

public function store_factory(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'address'                => 'required|min:2',
       'balance'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


factory::create([
      'name'                => $request->name,
      'address'                => $request->address,
      'balance'                => $request->balance,
      'status'                => $request->status,

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider factory 
public function update_factory(Request $request, $id){

$management = factory::find($id);

  $validator = Validator::make($request->all(), [

     
    'name'                => 'required|min:2',
    'address'                => 'required|min:2',
    'balance'                => 'required|min:2',
    'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
    'name'                => $request->name,
    'address'                => $request->address,
    'balance'                => $request->balance,
    'status'                => $request->status,
 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

return response()->json("success");   


}

//Delete Slider factory 
public function delete_factory($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = factory::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function factory_change_sts($id){
  $voucher = factory::find($id);

 
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
