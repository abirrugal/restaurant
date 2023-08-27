<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

  public function alldata(){
    $infos = Category::latest()->get();

    return response()->json($infos);
  }
     //category 
public function category(){

  
      $infos = Category::latest()->paginate(20);
   

    return view('backend.basic_settings.category.index', compact('infos'));
    // return response()->json($infos);

 
     }

     public function edit_data ($id){

      $data = Category::findOrFail($id);
      return response()->json($data);
    }

 
  //Store category 
 
  public function store_category(Request $request){
 
     $validator = Validator::make($request->all(), [
   
         'name'                => 'required|min:2',
         'status'                => 'required|min:2',
     ]);
 
     if($validator->fails()){
         return redirect()->back()->withErrors($validator)->withInput();
     }
 

 Category::create([
        'serial'                => $request->serial,
        'name'                => $request->name,
        'status'                => $request->status,
  
 ]);
 return response()->json('Created success');
    //  $this->successMessage('Created success');
    //  return redirect()->back();
 
 
  }
 

 
  //Update Slider category 
  public function update_category(Request $request, $id){
 
 $management = Category::find($id);

    $validator = Validator::make($request->all(), [

       
        'name'                => 'required|min:2',
        'status'                => 'required|min:2',
        
     ]);
 
     if($validator->fails()){
         return redirect()->back()->withErrors($validator)->withInput();
     }

   $management->update([
    'serial'                => $request->serial,
    'name'                => $request->name,
    'status'                => $request->status,
   ]);

   return response()->json('Updated success');

    //  $this->successMessage('Updated success');
    //  return redirect()->back();
 
     
 
 
  }

  //Delete Slider category 
  public function delete_category($id){
 
    // if (auth()->user()->role_as !== 'creator'){

      $slider_img = Category::find($id);
  
      $slider_img->delete();
      return response()->json("Deleted Success");
      // $this->successMessage('Deleted success');
      // return redirect()->back();
    // }

  }

  public function category_change_sts($id){
    $voucher = Category::find($id);

   
    if ($voucher->status == "Active") {
     
      $voucher->status = "Inactive";
      $voucher->save();
    }else{

      
      $voucher->status = "Active";
      $voucher->save();
    }
    
return response()->json('Status Changed Success');
    // $this->successMessage('Status Changed Success');
    // return redirect()->back();
  }



    
}
