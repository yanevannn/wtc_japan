<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    function doLogin(Request $request){
       $data =[
              'email' => $request->email,
              'password' => $request->password
       ];

       if(Auth::attempt($data)){

           return redirect()->route('dashboard');

         }else{
              return redirect()->route('login')->withErrors('Email dan Password salah !');
            }
    }

    function register(){
        return view('auth.register');
    }

    function doRegister(Request $request){
        dd($request->all());
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
