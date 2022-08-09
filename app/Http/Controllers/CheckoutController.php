<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
// use Midtrans\Transaction;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request) {
        // save user data 
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // process checkout
        $code = 'STORE-' .  mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
        ->where('users_id', Auth::user()->id)
        ->get();

        // transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code          
        ]);
        
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 999999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // return dd($transaction)

        // delete cart data after checkout
        Cart::with(['product', 'user'])
                    ->where('users_id', Auth::user()->id)
                    ->delete();
        // also you can make similar this: Cart::where('users_id', Auth::user()->id)->delete();

        // konfigurasi midtrans
            // Set your Merchant Server Key
            Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept             real transaction).
            Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            Config::$is3ds = config('services.midtrans.is3ds');

        // buat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => (int) $request->total_price,
                ],
            'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            'enabled_payments' => [
                'gopay', 'bank_transfer'
                ],
                'vtweb' => [
                ]
            ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // set midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // instance midtrans notification
        $notification = New Notification();
        
        // assign to variable for easy coding
        $status  = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // search transaction based id
        $transaction = Transaction::findOrFail($order_id);

        // handle notification status
        // if ($status == 'capture' && $type == 'credit_card' && $fraud == 'challenge'){$transaction->status = 'PENDING';} else {transaction->status='SUCCESS';}
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        } else if($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        } else if($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } else if($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } else if($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // save transaction
        $transaction->save();
    }
}