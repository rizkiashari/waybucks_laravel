<?php

namespace App\Http\Controllers;

use App\Models\topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToppingController extends Controller
{
    public function index()
    {
        return view('addtopping', [
            'title' => 'Add Topping',
            'active' => Auth::user(),
        ]);
    }

    public function insert(Request $request)
    {
        $addTopping = new topping();

        $request->validate([
            'name_topping' => 'required|unique:toppings',
            'price_topping' => 'required|numeric|min:1000',
        ]);

        $photo_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('/public/images/', $photo_name);

        $addTopping->name_topping = $request->name_topping;
        $addTopping->price_topping = $request->price_topping;
        $addTopping->photo_topping = $photo_name;

        $addTopping->save();

        return back()->with('success', 'Topping has been added');
    }
}
