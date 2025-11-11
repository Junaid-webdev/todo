<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    function login(){
        return view('auth.login');
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error','Invalid Email Or Password');
    }

    function register(){
        return view('auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|',
            'password' => 'required|min:8',
        ]);
        $User = new User();
        $User->name = $request->name; 
        $User->email = $request->email; 
        $User->password = $request->password;
        if($User->save()){
            return redirect(route('login'))->with('Success','Registration Successfully!');
        }
        return redirect(route('register'))->with('error','Registration Failed');
    }
    
    function logout(Request $request){
        Session::flush();
        Auth::logout();
         return redirect()->route('login');
    }
}
