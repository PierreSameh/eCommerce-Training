<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
     // Create and Add to Cart
    public function addToCart(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->cart_id, 'product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );
        
        return back()->with('success', 'Product added to cart!');
    }

    // show Cart
    public function show() {
        Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
        
        return view('pages/cart', ['cartItems' => $cartItems]);
    }
}
