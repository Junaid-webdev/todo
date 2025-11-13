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
    // Show Login Form //

     public function login()
    {
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('auth.login');
    }



    // Register Form //
    public function register()
    {
        if(Auth::check()){
            return redirect(route('home'));
        

        }
        return view('auth.register');
    }

    
     public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // regenerate session to prevent fixation
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return redirect()->route('auth.login')->with('error', 'Login details are not valid');
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
        $User->password = Hash::make($request->password);
        if($User->save()){
            return redirect(route('auth.login'))->with('Success','Registration Successfully!');
        }
        return redirect(route('register'))->with('error','Registration Failed');
    }
    
    function logout(Request $request){
        Session::flush();
        Auth::logout();
         return redirect()->route('auth.login');
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
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'work' => 'required',
            'duedate' => 'required'
        ]);
        $id=$request['id'];
   $todo = todos::find($id);
       $todo->name=$request['name'];
       $todo->work=$request['work'];
       $todo->duedate=$request['duedate'];
       $todo->save();
            return redirect()->intended(route('todo'));    }
}
   