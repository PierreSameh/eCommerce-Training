<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ShipmentDetail;
use App\Models\User;
use App\Models\Product;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Show Checkout page
    public function show() {
        // Send Order Items
        $order = Order::where("user_id", auth()->user()->id)->latest()->first();
        $orderItems = OrderItem::where("order_id", $order->id)->get();
        if(!count($orderItems) == 0) {
            // Counting total price
            $total = 0;
            foreach ($orderItems as $orderItem) {
                $totalPrice = $orderItem->Quantity * $orderItem->product->price;
                $total += $totalPrice;
            }


        return view("pages/checkout", ['orderItems' => $orderItems ,'total'=> $total]);

         }
    }
    public function store(Request $request) {
        $order = Order::where('user_id', auth()->id())->latest()->first();
        // Getting user's cart
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
        // $orderItems = OrderItem::where('order_id', $order->id)->get();

          // Validate the request data
          $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|min:11|numeric',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);
        // Store the data in the database
        // Request Form Data
        $fname = request()->fname;
        $lname = request()->lname;
        $phone = request()->phone;
        $email = request()->email;
        $country = request()->country;
        $address1 = request()->address1;
        $address2 = request()->address2;
        $city = request()->city;
        $zip_code = request()->zip_code;
        $notes = request()->notes;

        // Insert Into DB
        ShipmentDetail::create([
            'order_id' => $order->id,
            'fname' => $fname,
            'lname'=> $lname,
            'phone'=> $phone,
            'email'=> $email,
            'country'=> $country,
            'address1'=> $address1,
            'address2'=> $address2,
            'city'=> $city,
            'zip_code'=> $zip_code,
            'notes'=> $notes
        ]);

        // Delete Cart when Order Placed
        CartItem::where('cart_id', $cart->cart_id)->delete();

        Cart::where('cart_id', $cart->cart_id)->delete();

        // Redirect or respond with a success message
        return to_route('confirmation.show');
    }

    public function confirmation() {
        $order = Order::where('user_id', auth()->id())->latest()->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $shipDetails = ShipmentDetail::where('order_id', $order->id)->latest()->first();

         // Counting total price
        $subtotal = 0;
        foreach ($orderItems as $orderItem) {
            $totalPrice = $orderItem->Quantity * $orderItem->product->price;
            $subtotal += $totalPrice;
        }
        return view('pages/confirmation', ['order' => $order, 'orderItems' => $orderItems,
         'shipDetails' => $shipDetails, 'subtotal' => $subtotal]);
    }
}