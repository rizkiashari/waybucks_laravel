<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

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
            $topping = $request->topping;
            $dataTopping = [];
            foreach ($topping as $key => $value) {
                $dataTopping[] = [
                    'id_topping' => $key,
                    'price_topping' => $value,
                    'name_topping' => Topping::where('id', $key)->first()->name_topping,
                ];
            }
            if (Auth::check()) {
                if (!$cart) {
                    $cart = json_decode($cart, 60);
                    $cart[] = [
                        'id_cart' => Str::uuid()->toString(),
                        'id_product' => $product->id,
                        'name_product' => $product->name_product,
                        'photo_product' => $product->photo_product,
                        'price_product' => $product->price_product,
                        'toppings' => $dataTopping,
                        'qty_transaction' => 1,
                    ];

                    Cookie::queue('cart', json_encode($cart), 60);
                    return back()->with('success', 'Product added to cart');
                } else {

                    $cart = json_decode($cart, 60);
                    $checkId = array_filter($cart, function ($value) use ($product) {
                        return $value['id_product'] == $product->id;
                    });


                    if (count($checkId) > 0) {
                        foreach ($checkId as $key => $value) {
                            $cart[$key]['qty_transaction'] += 1;

                            $cart[$key]['toppings'] = array_merge($cart[$key]['toppings'], $dataTopping);

                            // $checkIdTopping = array_filter(
                            //     $cart[$key]['toppings'],
                            //     function ($value) use ($dataTopping) {
                            //         return $value['id_topping'] == $dataTopping[0]['id_topping'];
                            //     }
                            // );

                            // if (count($checkIdTopping) > 0) {
                            //     foreach ($checkIdTopping as $key2 => $value2) {
                            //         $cart[$key]['toppings'][$key2]['price_topping'] += $dataTopping[$key2]['price_topping'];
                            //     }
                            // } else {
                            //     $cart[$key]['toppings'] = array_merge($cart[$key]['toppings'], $dataTopping);
                            // }
                        }
                    } else {
                        $cart[] = [
                            'id_cart' => Str::uuid()->toString(),
                            'id_product' => $product->id,
                            'name_product' => $product->name_product,
                            'photo_product' => $product->photo_product,
                            'price_product' => $product->price_product,
                            'toppings' => $dataTopping,
                            'qty_transaction' => 1,
                        ];
                    }

                    Cookie::queue('cart', json_encode($cart), 60);
                    // dd($cart);
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
