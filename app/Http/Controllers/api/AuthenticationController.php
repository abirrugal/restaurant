<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends ApiBaseController
{
    public function register(Request $request){



        $validator = Validator::make($request->all(), [
    
           
            'image'       => 'required',
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8'
            
         ]);
     
         if($validator->fails()){
            return $this->sendError("Validation Error." , $validator->errors());
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


  $user =  User::create([
    'image' => $final_name1,
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
             'token_type' => 'Bearer',
]);
       
    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
            'message' => 'Invalid login details'
                       ], 401);
                   }
            
            $user = User::where('email', $request['email'])->firstOrFail();
            
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                       'access_token' => $token,
                       'token_type' => 'Bearer',
            ]);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function me(Request $request){
        return auth()->user();
    }
}
