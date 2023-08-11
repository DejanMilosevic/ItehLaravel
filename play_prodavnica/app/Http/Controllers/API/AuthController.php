<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:150',
            'email'=>'required|string|max:200|email|unique:users',
            'password'=>'required|string|min:5'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Uspesna registracija', 'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=>'Ne postoji korisnik sa tim kredencijalima'],401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Uspesno ulogovan.', 'user' => $user, 'token' => $token]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return ['message'=>'Uspesno ste se odjavili.'];
    }
}
