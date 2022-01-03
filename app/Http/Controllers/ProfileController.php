<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        
        return view('profile', [
            'title' => 'Profile',
            'user' => auth()->user(),
            'title' => 'Profile' . auth()->user()->name,
        ]);
    }
}
