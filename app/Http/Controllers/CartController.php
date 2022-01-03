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
            $subTotal = 0;

            foreach ($cart as $key => $value) {
                $qty += $value['qty_transaction'];
                $total += $value['price_product'];
            }
            $subTotal += $total;

            // remove duplicate topping by topping_id
            foreach ($cart as $key => $value) {
                $cart[$key]['topping'] = array_unique(array_column($value['toppings'], 'name_topping'));
            }

            return view('cart', [
                'title' => 'Cart',
                'active' => Auth::user(),
                'carts' => $cart,
                'subTotal' => $subTotal,
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
