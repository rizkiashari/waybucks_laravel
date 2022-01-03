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
            $cart = json_decode($cart, 60);
            // dd($cart);
            $qty = 0;
            $total = 0;
            $totalTop = 0;
            // foreach ($cart as $key => $value) {
            //     $qty += $value['qty_transaction'];
            //     $orderTop = 0;

            //     foreach ($value['toppings'] as $key2 => $value2) {
            //         $orderTop += $value2['price_topping'];
            //     }

            //     $total += $value['price_product'] + $orderTop;
            // }
            // dd($orderTop);

            $total += $totalTop;
            // dd($qty . ' ' . $total . ' ' . $totalTop);


            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'carts' => $cart,
                'total' => $total,
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
