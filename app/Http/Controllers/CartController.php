<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cookie::get('cart');
        if ($cart) {
            // dd($cart);
            $cart = json_decode($cart, 60);
            $qty = 0;
            $total = 0;
            $totalTop = 0;
            foreach ($cart as $key => $value) {
                $qty += $value['qty_transaction'];
                $orderTop = 0;
                // $temp = 0;

                foreach ($value['toppings'] as $value2) {
                    $totalTop += $value2['price_topping'];

                    if ($value['id_product'] == $value2['id_product']) {
                        $orderTop += $value2['price_topping'];
                    }
                }
                // $temp = $orderTop + $value['price_product'];
                $total += $value['price_product'];
            }
            // dd($total);
            $total += $totalTop;

            // total order topping + price product 


            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'carts' => $cart,
                'total' => $total,
                // 'orderTotal' => $temp,
                'qty_transaction' => $qty,
            ]);
        } else {
            $cart = [];
            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'carts' => $cart,
            ]);
        }
    }

    public function deleteCart($id_cart)
    {
        $cart = Cookie::get('cart');
        $cart = json_decode($cart, 60);
        foreach ($cart as $key => $value) {
            if ($value['id_cart'] == $id_cart) {
                unset($cart[$key]);
            }
        }
        if (count($cart) == 0) {
            Cookie::queue(Cookie::forget('cart'));
        } else {
            Cookie::queue('cart', json_encode($cart), 60);
        }
        return back()->with('success', 'Product deleted from cart');
    }
}
