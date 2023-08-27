<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OtherIncomeSave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherIncomeController extends ApiBaseController
{
     //other_income_save 
public function other_income_save(){

  
    $infos = OtherIncomeSave::select('id','type','fund','amount','date','note')->latest()->get();
    // $other_income_head_type = OtherIncome::where('status','active')->select('name')->get();
    // $fund = Fund::where('status','active')->select('name')->get();


    return $this->sendResponse($infos,'Other Income List.');

   }


//Store other_income_save 

public function store_other_income_save(Request $request){

   $validator = Validator::make($request->all(), [
 
       'type'                => 'required|min:2',
       'fund'                => 'required|min:2',
       'amount'                => 'required|min:2',
       'date'                => 'required|min:2',
       'note'                => 'required|min:2',
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

   if($request->fund !==null){

    $date =Carbon::parse($request->date)
   ->toDateTimeString();

    OtherIncomeSave::create([
      'type'                => $request->type,
      'fund'                => $request->fund,
      'amount'                => $request->amount,
      'date'                => $date,
      'note'                => $request->note,

]);
   $this->successMessage('Created success');
   return redirect()->back();

   }else{
     $this->errorMessage("Please select a fund");
   }

   if($request->type !==null){

    OtherIncomeSave::create([
      'type'                => $request->type,
      'fund'                => $request->fund,
      'amount'                => $request->amount,
      'date'                => $request->date,
      'note'                => $request->note,

]);

return $this->sendResponse( [],'Created success');


   }else{

    return $this->sendResponse( [],'Please select a Other Income Head');

   }

}




//Update  other_income_save 
public function update_other_income_save(Request $request, $id){

$management = OtherIncomeSave::find($id);

  $validator = Validator::make($request->all(), [

     
    'type'                => 'required|min:2',
    'fund'                => 'required|min:2',
    'amount'                => 'required|min:2',
    'date'                => 'required|min:2',
    'note'                => 'required|min:2',
      
   ]);

   if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
   }

   $date =Carbon::parse($request->date)
   ->toDateTimeString();

 $management->update([
    'type'                => $request->type,
    'fund'                => $request->fund,
    'amount'                => $request->amount,
    'date'                => $date,
    'note'                => $request->note,
 ]);

 return $this->sendResponse( $management,'Updated success');

   


}

//Delete Slider other_income_save 
public function delete_other_income_save($id){

  // if (auth()->user()->role_as !== 'creator'){

    $slider_img = OtherIncomeSave::find($id);

    $slider_img->delete();
  
    return $this->sendResponse([],'Deleted Success');

  // }

}

public function other_income_save_change_sts($id){
  $voucher = OtherIncomeSave::find($id);

 
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

public function other_income_save_info_filter(Request $request){
  
  $start_date = Carbon::parse($request->start_date)
  ->toDateTimeString();

  $end_date = Carbon::parse($request->end_date)
  ->toDateTimeString();


  $infos = OtherIncomeSave::whereBetween('date', [$start_date,$end_date])->get();


  $income_sum = OtherIncomeSave::whereBetween('date', [$start_date,$end_date])->sum('amount');

//   $other_income_head_type = OtherIncome::where('status','active')->select('name')->get();
//   $fund = Fund::where('status','active')->select('name')->get();

return $this->sendResponse( [ 'search_result' => $infos, 'total_income'=> $income_sum] ,'Search Results.');

}

}
