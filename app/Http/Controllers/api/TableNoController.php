<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TableNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableNoController extends ApiBaseController
{
      //table 
    public function table(){
    
      
        $infos = TableNo::latest()->get();
     
    
        return $this->sendResponse($infos,'Table Number List.');
    
       }

       public function active(){
        $active_infos = TableNo::where('status', 'active')->latest()->get();
    
        return $this->sendResponse([
         $active_infos
        ],
          
          'Active Table Number List.');
    
       }
    
    
    
    
    //Store table 
    
    public function store_table(Request $request){
    
    
    
       $validator = Validator::make($request->all(), [
     
           'name'                => 'required|min:2',
         
       ]);
    
       if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    
    
    $infos =TableNo::create([
          'name'                => $request->name,
      
    
    ]);
    return $this->sendResponse( $infos,'Created success');

    
    
    }
    
    
    
    //Update Slider table 
    public function update_table(Request $request, $id){
    
    
    $management = TableNo::find($id);
    
      $validator = Validator::make($request->all(), [
    
         
          'name'                => 'required|min:2',
    
          
       ]);
    
       if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    
     $management->update([
      'name'                => $request->name,
    
     ]);
    
  
      return $this->sendResponse( $management,'Updated success');
       
    
    
    }
    
    
    
    
    
    //Delete Slider table 
    public function delete_table($id){
    
    
        $slider_img = TableNo::find($id);
    
        $slider_img->delete();
      
      
        return $this->sendResponse([],'Deleted Success');

    }
}
