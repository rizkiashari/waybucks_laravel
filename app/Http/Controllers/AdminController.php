<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminView()
    {
        $transactions = Transaction::paginate(6);



        // dd($total);
        return view('admin', [
            'title' => 'Admin',
            'active' => Auth::user(),
            'transactions' => $transactions
        ]);
    }

    public function cancelStatus($uuid)
    {
        $transaction = Transaction::where('uuid_transaction', $uuid)->first();

        $transaction->status_transaction = 'Cancel';

        $transaction->save();

        return back()->with('success', 'Transaction has been canceled');
    }

    public function onTheWayStatus($uuid)
    {
        $transaction = Transaction::where('uuid_transaction', $uuid)->first();

        $transaction->status_transaction = 'On The Way';

        $transaction->save();

        return back()->with('success', 'Transaction has been on the way');
    }
}
