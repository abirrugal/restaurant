<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product 
public function product(){

  
    $infos = Product::latest()->paginate(20);
    $categories = Category::where('status','Active')->select('name','id')->get();

  return view('backend.basic_settings.product.index', compact('infos','categories'));

   }

public function edit_product($id){

    $info_edit = Product::findOrFail($id);

    return response()->json($info_edit);
}


//Store product 

public function store_product(Request $request){

    

   $validator = Validator::make($request->all(), [
 
       'category_id'         =>'required',
       'name'                => 'required|min:2',
       'image'               => 'required|mimes:png,jpg.jpeg',
       'details'             => 'required|min:2',
        'rate'               => 'required',
       'status'              => 'required|min:2',
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

$image = $request->file('image');
$name_gen = hexdec(uniqid());
$img_ext = strtolower($image->getClientOriginalExtension());
$img_name = $name_gen.'.'.$img_ext;
$up_location = 'image/product/';
$last_img = $up_location.$img_name;
$image->move($up_location, $img_name);


if($request->flavor === "yes"){
    $flavor = 'yes';
}else{
    $flavor = 'no';
}

if($request->cflavor === "yes"){
    $cflavor = 'yes';
}else{
    $cflavor = 'no';

}
if($request->add_ons === "yes"){
    $add_ons = 'yes';
}else{
    $add_ons = 'no';

}


Product::create([
      'name'                => $request->name,
      'image'                => $last_img,
      'details'                => $request->details,  
      'status'                => $request->status,
      'category_id'                => $request->category_id,
      'rate'                => $request->rate,
      'flavor'                => $flavor,
      'cflavor'                => $cflavor,
      'add_ons'                => $add_ons,
      'sd_paid'                => $request->sd_paid,
      'sd_drink'                => $request->sd_drink,


]);
   $this->successMessage('Created success');
   return redirect()->back();


}



//Update Slider product 
public function update_product(Request $request, $id){

$management = Product::find($id);

  $validator = Validator::make($request->all(), [

     
    'category_id'         =>'required',
       'name'                => 'required|min:2',
       'details'             => 'required|min:2',
        'rate'               => 'required',
       'status'              => 'required|min:2',
      
   ]);

   if($validator->fails()){
       return redirect()->back()->withErrors($validator)->withInput();
   }

  
   $image = $request->file('image');
   if($image){

    unlink($management->image);

    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'image/product/';
    $last_img = $up_location.$img_name;
    $image->move($up_location, $img_name);

    $management->image = $last_img;
    $management->save();
   }

   if($request->flavor === "yes"){
    $flavor = 'yes';
}else{
    $flavor = 'no';
}

if($request->cflavor === "yes"){
    $cflavor = 'yes';
}else{
    $cflavor = 'no';

}
if($request->add_ons === "yes"){
    $add_ons = 'yes';
}else{
    $add_ons = 'no';

}


 $management->update([
    'name'                => $request->name,
    'details'                => $request->details,  
    'status'                => $request->status,
    'category_id'                => $request->category_id,
    'rate'                => $request->rate,
    'flavor'                => $flavor,
    'cflavor'                => $cflavor,
    'add_ons'                => $add_ons,
    'sd_paid'                => $request->sd_paid,
    'sd_drink'                => $request->sd_drink,
 ]);

 return response()->json();
//    $this->successMessage('Updated success');
//    return redirect()->back();

   


}

//Delete Slider product 
public function delete_product($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = Product::find($id);

    $slider_img->delete();
    $this->successMessage('Deleted success');
    return redirect()->back();
  // }

}

public function product_change_sts($id){
  $voucher = Product::find($id);

 
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
