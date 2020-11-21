<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Validator;

class AuthController extends ResponseController
{
    //create user
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
           // 'name' => 'required|string|',
           // 'email' => 'required|string|email|unique:users',
            //'password' => 'required',
            'mobile' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $user = User::where('mobile',$request->mobile)->first();
        $success['status'] =  1;
        $success['message'] = "Welcome Back";
        if(!$user){
            $user =New User();
            $user->mobile = $request->mobile;
            $user->email = $request->mobile.'@text.com';
            $user->password = bcrypt($request->mobile);
            $user->save();
            $user =  User::where('id',$user->id)->first();
            $success['message'] = "Welcome";
        }
       if($user){
            $success['data'] =  $user;
            $success['token'] =  $user->createToken('token')->accessToken;
            return $this->sendResponse($success);
        }
        else{
            $error = "Sorry! Registration is not successfull.";
            return $this->sendError($error, 401);
        }

    }

       //login
       public function login(Request $request)
       {
           $validator = Validator::make($request->all(), [
               'email' => 'required|string|email',
               'password' => 'required'
           ]);

           if($validator->fails()){
               return $this->sendError($validator->errors());
           }

           $credentials = request(['email', 'password']);
           if(!Auth::attempt($credentials)){
               $error = "Unauthorized";
               return $this->sendError($error, 401);
           }
           $user = $request->user();
           $success['user'] =  $user;
           $success['user']['role'] =  $user->roles->pluck('id');
           $success['token'] =  $user->createToken('token')->accessToken;
           return $this->sendResponse($success);
       }

    //logout
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['status'] =  1;
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $success['status'] =  0;
            $error = "Something went wrong.";
            $success['message'] = $error;
            return $this->sendResponse($error);
        }


    }
     //logout
     public function verify(Request $request)
     {

         $isUser = $request->otp;
         if($isUser == '123456'){
             $user = auth()->user();
             $user->email_verified_at = Carbon::now();
             $user->save();
            $success['status'] =  1;
             $success['message'] = "Successfully Verified.";
             return $this->sendResponse($success);
         }
         else{
             $error = "wrong OTP.";
             $success['status'] =  0;
             $success['message'] = $error;
             return $this->sendResponse($error);
         }


     }

    //getuser
    public function getUser(Request $request)
    {
        $id = $request->user;
        if($request->user){
            $user = User::find($id);
        }else{
            $user = auth()->user();
        }
        if($user){
            return $this->sendResponse($user);
        }
        else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }
}
