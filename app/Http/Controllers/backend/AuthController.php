<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function create_account(){
   
        return view('backend.auth.register');
    }
   
    

public function store_account(Request $request){

            
   if(auth()->user()->role_as === 'superadmin'){


    $validator = Validator::make($request->all(), [
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        'name' => 'required|min:4|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:8|confirmed'

    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->withInput();
    }


    $image_file = $request->file('image');

    if($image_file){
 
     $img_gen = hexdec(uniqid());
     $image_url = 'auth/profile_img/';
     $image_ext = strtolower($image_file->getClientOriginalExtension());
 
 
     $img_name = $img_gen.'.'.$image_ext;
     $final_name1 = $image_url.$img_gen.'.'.$image_ext;
 
     $image_file->move($image_url, $img_name);

 
}


 User::create([
        'image' => $final_name1,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);


        $this->successMessage('Registration successfull');


        return redirect()->back();
}

    }

    public function user_list(){
           $user_list =  User::all();
  
        return view('backend.auth.index' , compact('user_list'));
    }

    public function delete_user($id){
                 if(auth()->user()->role_as === 'superadmin'){
  
          $slider_img = User::find($id);
          $slider_img->delete();
    if($slider_img->image){

        unlink($slider_img->image);
    }
         
          $this->successMessage('Deleted success');
          return redirect()->back();
          }
    }

public function changeRole(Request $request){


    if(auth()->user()->role_as === 'superadmin'){
  
      $user = User::find($request->user_id);
  
      $role = $request->role;

      $user->role_as = $role;
            $user->save();
            session()->flash('type','success');
            session()->flash('message','User role changed success');
            return redirect()->back();
         
  }

   
}

public function login(){
        return view('backend.auth.login');

}

public function login_store(Request $request){

     $validator = Validator::make($request->all(), [
        
        'email' => 'required|email|max:255',    
        'password' => 'required|min:4'

    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->withInput();
    }


    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        $this->successMessage('Logged in success');
        if (auth()->user()->role_as === 'superadmin' || auth()->user()->role_as === 'admin' || auth()->user()->role_as === 'creator' || auth()->user()->role_as === 'cashier' || auth()->user()->role_as === 'kitchen' || auth()->user()->role_as === 'waiter') {
            return redirect()->route('admin.index');
        }else{
            
            echo "Permission Denied";
        }
    } else{
        $this->errorMessage('Wrong User Details.');
        return redirect()->back();
    }

}



  public function logout(){
    Auth::logout();
    $this->successMessage('Logout success');
    return redirect()->route('login');
  }



}
