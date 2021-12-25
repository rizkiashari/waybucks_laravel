<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailProductController extends Controller
{
    public function detailProduct()
    {
        return view('detailproduct', [
            'title' => 'Detail Product',
            'active' => Auth::user(),
        ]);
    }
}
