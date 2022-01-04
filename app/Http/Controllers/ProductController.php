<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product', [
            'title' => 'Product',
            'active' => Auth::user(),
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addproduct', [
            'title' => 'Add Product',
            'active' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return redirect('product')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('updateproduct', [
            'title' => 'Update Product',
            'active' => Auth::user(),
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // $product = Product::find($id);
        $request->validate([
            'name_product' => 'required|unique:products',
            'slug_product' => 'unique:products',
            'price_product' => 'required|numeric|min:1000',
            'qty_product' => 'required|numeric|min:1',
            'file' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $photo_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('/public/images/', $photo_name);

        $product->name_product = $request->name_product;
        $product->slug_product = Str::slug($request->name_product, '-');
        $product->price_product = $request->price_product;
        $product->qty_product = $request->qty_product;
        $product->photo_product = $photo_name;

        $product->save();

        return redirect('product')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteproduct = Product::find($id);
        $deleteproduct->delete();

        return back();
    }
}
