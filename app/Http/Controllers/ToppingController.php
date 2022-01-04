<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toppings = Topping::all();
        return view('topping', [
            'title' => 'Topping',
            'active' => Auth::user(),
            'toppings' => $toppings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addtopping', [
            'title' => 'Add Topping',
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

        return redirect('topping')->with('success', 'Topping has been added');
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
    public function edit(Topping $topping)
    {
        return view('updatetopping', [
            'title' => 'Update Topping',
            'active' => Auth::user(),
            'topping' => $topping,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topping $topping)
    {
        $request->validate([
            'name_topping' => 'required|unique:toppings',
            'price_topping' => 'required|numeric|min:1000',
        ]);

        $photo_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('/public/images/', $photo_name);

        $topping->name_topping = $request->name_topping;
        $topping->price_topping = $request->price_topping;
        $topping->photo_topping = $photo_name;

        $topping->save();

        return redirect('topping')->with('success', 'Topping has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletetooping = Topping::find($id);
        $deletetooping->delete();

        return back();
    }
}
