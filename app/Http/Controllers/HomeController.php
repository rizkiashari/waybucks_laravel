<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (User::find(Auth::id())->role->name_role == 'admin') {
                return redirect('/admin');
            }
            return redirect('/');
        }
        return back()->withErrors(['auth' => 'Invalid email or password.']);
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
            'email' => ['required', 'email', 'unique:users'],
            'fullname' => ['required', 'alpha'],
            'password' => ['required'],
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::where('name_role', 'customer')->value('id');
        $user->save();
        return redirect('/login');
    }
    
    public function logout(Request $request, User $user)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function adminView()
    {
        return view('admin', [
            'title' => 'Admin',
            'active' => Auth::user(),
        ]);
    }

    public function cartView()
    {
        return view('cart', [
            'title' => 'Cart',
            'active' => Auth::user(),
        ]);
    }
}
