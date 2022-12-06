<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function resister(Request $request){
    $validator = Validator::make($request->all(),[
        'name'=>'required|string|min:2|max:100',
        'email'=>'required|string|email|max:100|unique:users',
        'password'=>'required|string|max:6|confirmed'
    ]);
    if($validator->fails()){
        return response()->json($validator->errors(),400);
    }
    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
    ]);
    return response()->json([
        'massage'=>"Hee ayush you resister successfuly",
        'user'=>$user
    ]);
   }


   public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=>'required|string|max:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        if(!$token=auth()->attempt($validator->validated())){
            return response()->json(['error'=> 'Unauthorized']);
        }
        return $this->responseWithToken($token);
    }
    protected function responseWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]);
   }
   public function profile(){
    return  response()->json(auth()->user());
   }
   public function refresh(){
    return $this-> responseWithToken(auth()->refresh());
   }
   public function logout(){
        auth()->logout();

    return  response()->json(['massage'=>'User is logout ayush']);
   }
}
