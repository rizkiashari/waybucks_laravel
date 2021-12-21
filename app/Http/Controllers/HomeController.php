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
            'active' => 'home',
        ]);
    }
    public function loginView()
    {
        return view('login');
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
        return back();
    }
    public function registerView()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
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
