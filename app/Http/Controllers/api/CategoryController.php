<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ApiBaseController
{

         //category 
    public function category(){
    
      
          $all_infos = Category::latest()->get();
          $active_infos = Category::where('status', 'active')->latest()->get();

       
          return $this->sendResponse([
            $all_infos,
            'active_category'=>$active_infos
          ],
            
            'Category List.');

         }

   public function active(){
          $active_infos = Category::where('status', 'active')->latest()->get();

          return $this->sendResponse([
           $active_infos
          ],
            
            'Active Category List.');

         }
    

     
      //Store category 
     
      public function store_category(Request $request){
     
         $validator = Validator::make($request->all(), [
       
             'name'                => 'required|min:2',
             'status'                => 'required|min:2',
         ]);
     
         if($validator->fails()){
            return $this->sendError("Validation Error." , $validator->errors());
        }
     
    
        $data =  Category::create([
            'serial'                => $request->serial,
            'name'                => $request->name,
            'status'                => $request->status,
      
     ]);

     return $this->sendResponse($data,'Created Success');
  
      
      }
     
    
     
      //Update Slider category 
      public function update_category(Request $request, $id){
     
     $management = Category::find($id);
    
        $validator = Validator::make($request->all(), [
    
           
            'name'                => 'required|min:2',
            'status'                => 'required|min:2',
            
         ]);
     
         if($validator->fails()){
            return $this->sendError("Validation Error." , $validator->errors());
         }
    
       $management->update([
        'serial'                => $request->serial,
        'name'                => $request->name,
        'status'                => $request->status,
       ]);
    
       return $this->sendResponse($management, 'Updated Success.');
    

      
      }
    
      //Delete Slider category 
      public function delete_category($id){
     
    
          $slider_img = Category::find($id);
      
          $slider_img->delete();

          return $this->sendResponse([], 'Deleted Success.');
    
    
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
        
        $status = $voucher->status;
  
        return $this->sendResponse($status, 'Status Changed To ' . $status . ' Success');
  
      }
}
