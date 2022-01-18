<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionTopping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->select('transactions.*')
            ->where('transactions.user_id', Auth::user()->id)
            ->orderBy('transactions.created_at', 'desc')
            ->paginate(4);

        $detailTransaction = TransactionDetail::join('products', 'products.id', '=', 'transaction_details.product_id')
            ->select('transaction_details.*', 'products.name_product as NameProduct', 'products.photo_product as PhotoProduct')
            ->get();

        $toppingTransaction = DB::table('transaction_toppings')
            ->join('transactions', 'transactions.id', '=', 'transaction_toppings.transaction_detail_id')
            ->join('toppings', 'toppings.id', '=', 'transaction_toppings.topping_id')
            ->select('transaction_toppings.*', 'toppings.name_topping as NameTopping')
            ->get();

        return view('profile', [
            'title' => 'Profile',
            'user' => auth()->user(),
            'title' => 'Profile' . auth()->user()->name,
            'transactions' => $transactions,
            'detailTransactions' => $detailTransaction,
            'toppingTransaction' => $toppingTransaction
        ]);
    }

    public function photoProfile(Request $request, $id)
    {
        if (Auth::check()) {
            if ($request->profile) {
                $user = User::findOrFail($id);

                $request->validate([
                    'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $photo_name = $request->file('profile')->getClientOriginalName();
                $request->file('profile')->storeAs('/public/profile/', $photo_name);

                $user->profile = $photo_name;

                $user->save();

                return redirect()->back()->with('success', 'Photo Profile Updated');
            } else {
                return redirect()->back()->with('error', 'Photo Profile Not Updated');
            }
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page');
        }
    }

    public function changePassword()
    {
        return view('changepassword', [
            'title' => 'Change Password',
            'user' => auth()->user(),
            'title' => 'Profile' . auth()->user()->name,
        ]);
    }

    public function updatePassword(Request $request)
    {
        if (!Hash::check($request->current, auth()->user()->password)) {
            return back()->with('error', 'Current password does not match!');
        } else {
            $request->validate([
                'current' => 'required|alpha_num|min:6',
                'password' => 'required|alpha_num|min:6',
                'confirm' => 'nullable|min:6|same:password',
            ]);

            User::find(auth()->user()->id)->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->back()->with('success', 'Change Password updated successfully');
        }
    }
}
