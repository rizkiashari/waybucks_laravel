<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cookie::get('cart');
        // dd($cart);
        if ($cart) {
            $cart = json_decode($cart, 60);
            $subTotal = 0;
            $qty = 0;
            $total = 0;
            foreach ($cart as $key => $value) {
                $subTotal += $value['price_product'];
                $qty += $value['qty_transaction'];

                foreach ($value['toppings'] as $key2 => $value2) {
                    $total += $value2['price_topping'];
                }
            }
            // dd($total);
            // dd($qty);
            // dd($subTotal);
            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'cart' => $cart,
                'subTotal' => $subTotal,
                'qty_transaction' => $qty
            ]);
        } else {
            $cart = [];
            $total = 0;
            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'cart' => $cart,
            ]);
        }
    }
}
