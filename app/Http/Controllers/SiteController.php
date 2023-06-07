<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function loginForm() {
        $message = session('message');
        return inertia('Login',[
            'message' => $message,
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $login = auth()->attempt($request->all());

        if($login)
            return redirect('/dashboard')->with('message', "Welcome, $request->username");
        else
            return back()->withErrors(['authentication'=>'Invalid username and/or password.']);
    }

    public function registerForm() {
        return inertia('Register');
    }

    public function register(Request $request) {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // session()->flash('message', 'Your account has been created successfully');
        return redirect('/login')->with('message', 'Your account has been created successfully');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
