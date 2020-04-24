<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart()
    {
        $pdt = Product::find(request()->pdt_id);
        
        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');
        
        Session::flash('success', 'Proudct added successfuly');
        return redirect()->back();
    }

    public function cart()
    {
        // Cart::destroy();
        return view('cart');
    }

    public function cartDelete($id)
    {
        Cart::remove($id);

        Session::flash('success', 'Proudct removed successfuly');

        return redirect()->back();
    }

    public function cartDecr($id, $qty){

        Cart::update($id, $qty - 1);

        return redirect()->back();

    }

    public function cartIncr($id, $qty){

        Cart::update($id, $qty + 1);

        Session::flash('success', 'Proudct added successfuly');

        return redirect()->back();
    }

    public function rapid_add($id) 
    {
        $pdt = Product::find($id);
        
        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');

        Session::flash('success', 'Proudct added successfuly');
        
        return redirect()->back();
    }
}
