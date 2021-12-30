<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddProductController extends Controller
{
    public function index()
    {
        return view('addproduct', [
            'title' => 'Add Product',
            'active' => Auth::user(),
        ]);
    }

    public function insert(Request $request)
    {
        $addproduct = new product();

        $request->validate([
            'name_product' => 'required|unique:products',
            'slug_product' => 'unique:products',
            'price_product' => 'required|numeric|min:1000',
            'qty_product' => 'required|numeric|min:1',
            'file' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $photo_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('/public/images/', $photo_name);

        $addproduct->name_product = $request->name_product;
        $addproduct->slug_product = Str::slug($request->name_product, '-');
        $addproduct->price_product = $request->price_product;
        $addproduct->qty_product = $request->qty_product;
        $addproduct->photo_product = $photo_name;

        $addproduct->save();

        return back()->with('success', 'Product has been added');
    }
}
