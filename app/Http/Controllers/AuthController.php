<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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






    public function index(){
        $todos = todos::all();
        $data = compact('todos');
        return view('todo')->with($data);
    }
    public function store(Request $request){
       $request->validate([
        'name' => 'required',
        'work' => 'required',
        'duedate' => 'required'
       ]);
       $todo = new todos;
       $todo->name=$request['name'];
       $todo->work=$request['work'];
       $todo->duedate=$request['duedate'];
       $todo->save();
            return redirect()->intended(route('todo'));
    }
    public function delete($id){
        todos::find($id)->delete();
            return redirect()->intended(route('todo'));
    }
    public function edit($id){
        $todo = todos::find($id);
        $data=compact('todo');
        return view('update')->with($data);
    }
}
   