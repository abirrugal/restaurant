<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Chocolate_flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChocolateFlavorController extends Controller
{
      //chocolate_flavor 
public function chocolate_flavor(){

    

    $infos = Chocolate_flavor::select('name','status','id')->latest()->paginate(20);
 
  


  return view('backend.basic_settings.chocolate_flavor.index', compact('infos'));

   }


   public function alldata(){
    $infos = Chocolate_flavor::latest()->get();
    return response()->json($infos);
    

   }

   public function edit_data ($id){

    $data = Chocolate_flavor::findOrFail($id);
    return response()->json($data);
  }



//Store chocolate_flavor 

public function store_chocolate_flavor(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Chocolate_flavor::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);
return response()->json('Created success');
  //  $this->successMessage('Created success');
  //  return redirect()->back();


}



//Update Slider chocolate_flavor 
public function update_chocolate_flavor(Request $request, $id){

$management = Chocolate_flavor::find($id);

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

 return response()->json('Created success');

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

   


}

//Delete Slider chocolate_flavor 
public function delete_chocolate_flavor($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Chocolate_flavor::find($id);

    $slider_img->delete();
    return response()->json('Created success');

    // $this->successMessage('Deleted success');
    // return redirect()->back();
  // }

}

public function chocolate_flavor_change_sts($id){
  $voucher = Chocolate_flavor::find($id);

 
  if ($voucher->status == "Active") {
   
    $voucher->status = "Inactive";
    $voucher->save();
  }else{

    
    $voucher->status = "Active";
    $voucher->save();
  }
  
  return response()->json('Created success');


  // $this->successMessage('Status Changed Success');
  // return redirect()->back();
}
}
