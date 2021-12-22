<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Home',
            'active' => Auth::user(),
        ]);
    }
    public function loginView()
    {
        return view('login', [
            'title' => 'Login',
            'active' => Auth::user(),
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/home');
        }
        return back()->withErrors(['auth'=>'Invalid email or password.']);
    }
    public function registerView()
    {
        return view('register', [
            'title' => 'Register',
            'active' => Auth::user(),
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email','unique:users'],
            'fullname' => ['required', 'alpha'],
            'password' => ['required'],
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }
}
