<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser(){
        $user = User::all();
        return response()->json($user);
    }

    public function getMailsUsers(){
        $mails = User::select('email','username')->get();
        return response()->json($mails);
    }

    public function login(Request $request){
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            return response()->json($user,200);
        }
        else{
            return response()->json(['error' => "Cloud not log you in"], 401);
        }
    }

    public function logout(){
        Auth::logout();
        return response()->json('Logout success!');
    }

    public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->DOB = $request->DOB;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = HASH::make($request->password);
        $user->wallet = 0;
        $user->save();
       return response()->json(['message' => "Registration Complete!"]);
    }
}
