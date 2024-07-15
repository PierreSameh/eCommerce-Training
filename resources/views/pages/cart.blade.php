@extends('layouts.main')

@section('title', 'Cart')

@section('content')

<!-- breadcrumb part start-->
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>cart list</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!--================Cart Area =================-->
<section class="cart_area section_padding">
    <div class="container">
        <div class="cart_inner">
            @if ($cartItems->isEmpty())
            <p>Your Cart is Empty</p>
            @else
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $subtotal = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                            @php
                            $totalPrice = $item->Quantity * $item->product->price;
                            $subtotal += $totalPrice;
                            @endphp
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{asset('storage/' . $item->product->image)}}" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <p>{{$item->product->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{$item->product->price}}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input class="input-number" name="cartItems[{{$loop->index}}][Quantity]" type="number" value="{{$item->Quantity}}" min="1" max="10">
                                        <input type="hidden" name="cartItems[{{$loop->index}}][id]" value="{{$item->cartItem_id}}">
                                    </div>
                                </td>
                                <td>
                                    <h5>${{$item->product->price * $item->Quantity}}</h5>
                                </td>
                                <td>
                                </form>
                                    <form action="{{ route('cart.remove') }}" method="POST" onclick="return confirm('Are you sure?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="cartItem_id" value="{{ $item->cartItem_id }}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bottom_button">
                                <td>
                                    <button type="submit" value="{{route('cart.update')}}" class="btn_1">Update Cart</button>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>${{$subtotal}}</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
            <div class="checkout_btn_inner float-right">
                <a class="btn_1" href="{{route('shop.products')}}">Continue Shopping</a>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn_1 checkout_btn_1">Proceed to checkout</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

@endsection
