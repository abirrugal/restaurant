<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlavorController extends Controller
{
     //flavor 

    public function alldata(){
      $infos = Flavor::latest()->get();

      return response()->json($infos);
    }

    public function edit_data ($id){

      $data = Flavor::findOrFail($id);
      return response()->json($data);
    }

public function flavor(){

    $infos = Flavor::select('name','status','id')->latest()->paginate(20);
 
  return view('backend.basic_settings.flavor.index', compact('infos'));

   }



//Store flavor 

public function store_flavor(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Flavor::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);

return response()->json('Created success');
  //  $this->successMessage('Created success');
  //  return redirect()->back();


}



//Update  flavor 
public function update_flavor(Request $request, $id){

$management = Flavor::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',
      'status'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
  'name'                => $request->name,
  'status'                => $request->status,
 ]);

 return response()->json("Success");
 
  //  $this->successMessage('Updated success');
  //  return redirect()->back();


}

//Delete flavor 
public function delete_flavor($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Flavor::find($id);

    $slider_img->delete();
    return response()->json('Deleted');
    // $this->successMessage('Deleted success');
    // return redirect()->back();
  // }

}

public function flavor_change_sts($id){
  $voucher = Flavor::find($id);

 
  if ($voucher->status == "Active") {
   
    $voucher->status = "Inactive";
    $voucher->save();
  }else{

    
    $voucher->status = "Active";
    $voucher->save();
  }
  
return response()->json("Success");
  // $this->successMessage('Status Changed Success');
  // return redirect()->back();
}
}
