<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TableNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableNoController extends Controller
{
      //table 
public function table(){

  
    $infos = TableNo::latest()->paginate(20);
 

  return view('backend.table.index', compact('infos'));

   }


  public function edit_table($id){
    $info = TableNo::find($id);
    return response()->json($info);
  }

  

//Store table 

public function store_table(Request $request){



   $validator = Validator::make($request->all(), [
 
       'name'                => 'required|min:2',
     
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }


TableNo::create([
      'name'                => $request->name,
  

]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider table 
public function update_table(Request $request, $id){


$management = TableNo::find($id);

  $validator = Validator::make($request->all(), [

     
      'name'                => 'required|min:2',

      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

 $management->update([
  'name'                => $request->name,

 ]);

  //  $this->successMessage('Updated success');
  //  return redirect()->back();
return response()->json('Updated success');
   


}


//Delete Slider table 
public function delete_table($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = TableNo::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}
}
