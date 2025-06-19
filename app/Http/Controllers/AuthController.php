<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage(){
        return view('login');
    }

    public function login(LoginRequest $request){
        if (Auth::guard()->attempt(['username'=>$request->username,'password' => $request->password])) {
            toast('Welcome To Vats System','success');
            return redirect()->route('home');
        }
        toast('Wrong Credentials','error');
        return redirect()->route('loginPage');
    }
//
//    public function registerPage(){
//        return view('register');
//    }
//
//    public function register(RegisterRequest $request){
//        $user=User::create([
//            'username' => $request->username,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//        if (Auth::guard()->attempt(['username'=>$user->username,'password' => $request->password])) {
//            toast('Welcome To Vats System','success');
//            return redirect()->route('home');
//        }
//
//        toast('Wrong Credentials','error');
//        return redirect()->back();
//    }

    public function logout(){
        Auth::guard()->logout();
        toast('You have been Logged Out','success');
        return redirect()->route('login');
    }
}
