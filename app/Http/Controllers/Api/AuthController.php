<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        $success['token'] =  $user->createToken('token')->accessToken;
        return $this->sendResponse($success);
    }

    //logout
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }


    }
     //logout
     public function verify(Request $request)
     {

         $isUser = $request->otp;
         if($isUser == '123456'){
             $success['message'] = "Successfully Verified.";
             return $this->sendResponse($success);
         }
         else{
             $error = "wrong OTP.";
             return $this->sendResponse($error);
         }


     }

    //getuser
    public function getUser(Request $request)
    {
        $id = $request->user;
        if($request->user){
            $user = User::find($id);
            $user->isFollowing = auth()->user()->isFollowing($user);
            $user->hasRequested = auth()->user()->hasRequestedToFollow($user);
            $user->isBlock = auth()->user()->isBlock($user);
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
