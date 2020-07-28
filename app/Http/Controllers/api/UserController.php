<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
        //dd($request->password);
       $email = $request->email;
       $user = User::where('email',$email)->first();
       //dd($user);
       if($user){
        if(Hash::check($request->password, $user->password)){
            $token = Hash::make(Str::random(80));
            $user->api_token = $token;
            $user->save();
            return response()->json(['status' => $token], 200);
        }  
    }
       return response()->json(['status'=>'incorrect email/password combination'], 403);
    }
    public function verify(Request $request){
        //dd($request->user());
        return $request->user()->only('name','email','api_token');
    }
}
