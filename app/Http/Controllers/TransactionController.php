<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionTopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
    }

    public function storeTransaction(Request $request)
    {
        if (Auth::check()) {
            $cart = Cookie::get('cart');
            $cart = json_decode($cart, true);

            // dd($cart);
            $qty = 0;
            $total = 0;
            $subTotal = 0;
            foreach ($cart as $key => $value) {
                $qty += $value['qty_transaction'];
                $total += $value['price_product'];
            }
            $subTotal += $total;

            $request->validate([
                'name_transaction' => 'required',
                'email_transaction' => 'required|email:rfc,dns',
                'phone_transaction' => 'required|numeric|digits_between:10,13',
                'postal_code_transaction' => 'required|numeric|min:3',
                'file' => 'required',
                'address_transaction' => 'required|max:255|min:5',
            ], [
                'name_transaction.required' => 'Nama harus diisi',
                'email_transaction.required' => 'Email harus diisi',
                'email_transaction.email' => 'Email tidak valid',
                'phone_transaction.required' => 'Nomor telepon harus diisi',
                'phone_transaction.numeric' => 'Nomor telepon harus berupa angka',
                'phone_transaction.digits_between' => 'Nomor telepon harus antara 10 sampai 13 digit',
                'postal_code_transaction.required' => 'Kode pos harus diisi',
                'postal_code_transaction.numeric' => 'Kode pos harus berupa angka',
                'postal_code_transaction.min' => 'Kode pos harus terdiri dari 3 digit',
                'file.required' => 'Bukti pembayaran harus diisi',
                'address_transaction.required' => 'Alamat harus diisi',
                'address_transaction.max' => 'Alamat tidak boleh lebih dari 255 karakter',
                'address_transaction.min' => 'Alamat harus terdiri dari 5 karakter',
            ]);

            $transaction = new Transaction();

            $transaction->uuid_transaction = Str::uuid()->toString();
            $transaction->user_id = Auth::user()->id;
            $transaction->name_transaction = $request->name_transaction;
            $transaction->email_transaction = $request->email_transaction;
            $transaction->phone_transaction = $request->phone_transaction;
            $transaction->postal_code_transaction = $request->postal_code_transaction;

            $attach = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('/public/images/', $attach);
            $transaction->attach_transaction = $attach;

            $transaction->address_transaction = $request->address_transaction;
            $transaction->status_transaction = 'Waiting Approve';
            $transaction->total_transaction = $subTotal;

            $transaction->save();
            
            // insert topping to transaction_topping table
            foreach ($cart as $key => $cartValue) {
                $transactionDetail = new TransactionDetail();
                $transactionDetail->transaction_id = $transaction->id;
                $transactionDetail->product_id = $cartValue['id_product'];
                $transactionDetail->qty_transaction_detail = $cartValue['qty_transaction'];
                $transactionDetail->subTotal = $cartValue['price_product'];
                $transactionDetail->save();
                foreach ($cartValue['toppings'] as $key2 => $value2) {
                    $transactionTopping = new TransactionTopping();
                    $transactionTopping->transaction_detail_id = $transactionDetail->id;
                    $transactionTopping->topping_id = $value2['id_topping'];
                    $transactionTopping->save();
                }
            }

            Cookie::queue(Cookie::forget('cart'));

            // return redirect('/transaction/' . $transaction->uuid_transaction);
            return redirect('/')->with('success', 'Pesanan anda berhasil dikirim, kami akan segera mengirimkan pesanan anda');
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }
}
