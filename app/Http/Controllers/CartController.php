<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
     // Show Cart
     public function show() {
        return view('pages/cart');
    }
}
