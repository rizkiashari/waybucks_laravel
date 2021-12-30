<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailProductController extends Controller
{
    public function detailProduct(Product $product, Request $request)
    {
        $allTopping = Topping::all();

        return view('detailproduct', [
            'title' => 'Detail Product',
            'active' => Auth::user(),
            'product' => $product,
            'toppings' => $allTopping,
        ]);
    }
}
