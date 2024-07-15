<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;

class OrderController extends Controller
{
    // Store Order into DB
    public function store(Request $request)
    {
        // Getting user's cart
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
        if(!count($cartItems) == 0) {
        // Counting total price
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice = $cartItem->Quantity * $cartItem->product->price;
            $total += $totalPrice;
        }
    
        // Insert into Order Table
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
        ]);
        // Insert Cart items into Oreder_items table
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'Quantity' => $item['Quantity'],
                'price' => $item->product->price,
            ]);
        }
        // Delete Cart when Order Placed
        // CartItem::where('cart_id', $cart->cart_id)->delete();

        // Cart::where('cart_id', $cart->cart_id)->delete();


        return redirect()->route('checkout.show')->with('success', 'Order placed successfully.');
         } else {
            // Error situation
            return redirect()->route('cart.show', $cart->id)->with('error','Could not place your order');
             };
    }
}