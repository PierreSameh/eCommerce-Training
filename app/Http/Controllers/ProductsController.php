<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller
{
    public function dashboard() {
        return view('admin/create');
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price'=> 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the image file and get the path
            $imagePath = $request->file('image')->store('products', 'public');

            // Create new product record
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $imagePath;
            $product->save();

            return redirect()->route('dashboard.index')->with('success', 'Product created successfully.');
        }

        return back()->withInput()->with('error', 'Error uploading image.');
    }
    // Single Product Callback
    public function show(Product $product) {
        if (isset($user->id)) {
        Cart::firstOrCreate(['user_id' => auth()->id()]);
        };
        $cart = Cart::where('user_id', auth()->id())->first();

        return view('pages/singleproduct', ['product'=> $product, 'cart'=> $cart]);
    }
}
