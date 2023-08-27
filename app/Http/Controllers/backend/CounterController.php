<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CounterController extends Controller
{
     //counter 
public function counter(){

  
    $infos = Counter::select('name','status','id')->latest()->paginate(20);
 

  return view('backend.basic_settings.counter.index', compact('infos'));



   }

   public function alldata(){
   
     $infos = DB::table('counters')->get();
     return response()->json($infos);
    
   }

  //  public function fetch_data(Request $request){
  //   if($request->ajax())
  //   {
  //    $data = DB::table('counters')->paginate(5);
  //    return view('backend.basic_settings.counter.pagination', compact('data'))->render();
  //   }
  //  }

   function edit_data($id){
     $infos = Counter::findOrFail($id);
     return response()->json($infos);

   }


//Store counter 

public function store_counter(Request $request){

   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
       'status'                => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


Counter::create([
      'name'                => $request->name,
      'status'                => $request->status,

]);

return response()->json();
  //  $this->successMessage('Created success');
  //  return redirect()->back();


}



//Update Slider counter 
public function update_counter(Request $request, $id){

$management = Counter::find($id);

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

 return response()->json();

  //  $this->successMessage('Updated success');
  //  return redirect()->back();

   


}

//Delete Slider counter 
public function delete_counter($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Counter::find($id);

    $slider_img->delete();
    return response()->json();
    // $this->successMessage('Deleted success');
    // return redirect()->back();
  // }

}

public function counter_change_sts($id){
  $voucher = Counter::find($id);

 
  if ($voucher->status == "Active") {
   
    $voucher->status = "Inactive";
    $voucher->save();
  }else{

    
    $voucher->status = "Active";
    $voucher->save();
  }
  
  return response()->json();

  // $this->successMessage('Status Changed Success');
  // return redirect()->back();
}

}
