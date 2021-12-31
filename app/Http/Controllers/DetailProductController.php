<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class DetailProductController extends Controller
{
    public function detailProduct(Product $product)
    {
        $allTopping = Topping::all();

        return view('detailproduct', [
            'title' => 'Detail Product',
            'active' => Auth::user(),
            'product' => $product,
            'toppings' => $allTopping,
        ]);
    }

    public function addToCart($slug_product, Request $request)
    {
        $product = Product::where('slug_product', $slug_product)->first();

        $toppings = $request->topping;

        $dataTopping = [];
        foreach ($toppings as $key => $value) {
            $dataTopping[] = [
                'id_topping' => $key,
                'price_topping' => $value,
            ];
        }

        // add to cart cookies
        $cart = Cookie::get('cart');
        if (Auth::check()) {
            return redirect()->back();
        }else{
            return redirect('/login');
        }



    }
}
