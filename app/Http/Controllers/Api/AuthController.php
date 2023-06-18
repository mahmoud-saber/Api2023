<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>['required','string','max:225'],
            'email'=>['required','email','max:225','unique:'.User::class],
            'password'=>['required','confirmed' ,Password::defaults()],
        ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password'
        ]);

        if($validator->fails()) {
            return ApiResponse::SendResponse(422,'Register Validator Error ',$validator->messages()->all());
        }
       $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $data['token']=$user->createToken('Api')->plainTextToken;
        $data['name'] =$user->name;
        $data['email']=$user->email;

        return ApiResponse::SendResponse(201,'User Account Created Successful',$data);
    }

    #------------------------------login

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
             'email'=>['required','email','max:225'],
            'password'=>['required',Password::defaults()],
        ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password'
        ]);

        if($validator->fails()) {
            return ApiResponse::SendResponse(422,'Login Validator Error ',$validator->errors());
        }

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user =Auth::user();

                $data['token']=$user->createToken('Api')->plainTextToken;
                $data['name'] =$user->name;
                $data['email']=$user->email;
                return ApiResponse::SendResponse(200,'User Account Login Successful',$data);
            }
            else{
                return ApiResponse::SendResponse(401,'User Account Dosn`t exisit',null);

            }

    }

    #-------------------------------logout
    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return ApiResponse::SendResponse(200,'Logout Successful',[]);
    }
}