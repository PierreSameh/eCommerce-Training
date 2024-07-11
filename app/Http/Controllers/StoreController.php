<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;

use Illuminate\Http\Request;

class StoreController extends Controller
{
   // Index Route Callback
   public function index() {
    $products = Product::all();
    return view('index', ['products'=> $products]);
}

// About Callback
public function about() {
    return view('pages/about');
}
// Products Callback
public function products() {
    $products = Product::all();
    return view('pages/products', ['products'=> $products]);
}
// Contact Callback
public function contact() {
    return view('pages/contact');
}
}
