<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;


class CartController extends Controller
{
     // Create and Add to Cart
    public function addToCart(Request $request)
    {
        if(auth()->id()) {
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

             $cartItem = CartItem::where('cart_id', $cart->cart_id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                // If the item exists, increase the quantity
                $cartItem->Quantity += $request->Quantity;
                $cartItem->save();
            } else {
                // If the item does not exist, create a new cart item
                $cartItem = CartItem::create([
                    'cart_id' => $cart->cart_id,
                    'product_id' => $request->product_id,
                    'Quantity' => $request->Quantity,
                ]);
                
            }
            
            return back()->with('success', 'Product added to cart!');
        } else {
            return view('auth/register');

    }
    }

    // show Cart
    public function show() {
        Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
        
        return view('pages/cart', ['cartItems' => $cartItems]);
        
    }
    // Update cart item quantity
    public function updateCart(Request $request)
    {
        foreach ($request->cartItems as $item) {
            $cartItem = CartItem::find($item['id']);
            if ($cartItem) {
                $cartItem->Quantity = $item['Quantity'];
                $cartItem->save();
            }
        }

        return back()->with('success', 'Cart updated successfully!');
    }

    // Remove item from cart
    public function removeFromCart(Request $request)
    {
        $cartItem = CartItem::find($request->cartItem_id);
        if ($cartItem) {
            $cartItem->delete();
        }

        return back()->with('success', 'Item removed from cart!');
    }
}
