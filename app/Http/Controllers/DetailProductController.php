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
        // add to cart cookies
        $cart = Cookie::get('cart');
        if ($request->topping) {
            $reqTopping = $request->topping;
            $idTopping = "";
            foreach ($reqTopping as $key => $value) {
                $idTopping = $key;
            }

            $toppings = Topping::where('id', $idTopping)->select('id', 'name_topping', 'price_topping', 'photo_topping')->first();

            if (Auth::check()) {
                if (!$cart) {
                    $cart = json_decode($cart, 60);
                    $cart[] = [
                        'id_product' => $product->id,
                        'name_product' => $product->name_product,
                        'price_product' => $product->price_product,
                        'toppings' => $toppings,
                        'qty_transaction' => 1,
                    ];

                    Cookie::queue('cart', json_encode($cart), 60);
                    return back()->with('success', 'Product added to cart');
                } else {

                    $cart = json_decode($cart, 60);
                    $cart[] = [
                        'id_product' => $product->id,
                        'name_product' => $product->name_product,
                        'price_product' => $product->price_product,
                        'toppings' => $toppings,
                        'qty_transaction' => 1,
                    ];

                    Cookie::queue('cart', json_encode($cart), 60);
                    return back()->with('success', 'Product added to cart');
                }
            } else {
                return redirect('/login')->with('error', 'Please login or register to add product to cart');
            }
        } else {
            return redirect()->back()->with('error', 'Please select topping');
        }
    }
}
