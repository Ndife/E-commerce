<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::content()->count()==0){
            session()->flash('info', 'Your cart is empty. do so shopping.');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {
        $uuid = Str::uuid()->toString();
        Stripe::setApiKey(env('STRIPEAPIKEY'));

        $charge = Charge::create([
          "amount" => Cart::total() * 300,
          "currency" => "eur",
          "source" => request()->stripeToken, // obtained with Stripe.js
          "description" => "Nd E-commerce learning books"
        ], [
          "idempotency_key" => $uuid,
        ]);

        session()->flash('success', 'Purchase successful. wait for email.');

        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSucessful);

        return redirect('/');
    }
}
