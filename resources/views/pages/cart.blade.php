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
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $subtotal = 0;
                    @endphp
                    @foreach ($cartItems as $item )
                    @php
                        $totalPrice = $item->Quantity * $item->product->price;
                        $subtotal += $totalPrice;
                    @endphp
                    <tr>
                      <td>
                        <div class="media">
                          <div class="d-flex">
                            {{-- <img src="{{$item->prodcut->asset('storage/'. image)}}" alt="" /> --}}
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
                          <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                          <input class="input-number" type="text" value="{{$item->Quantity}}" min="0" max="10">
                          <span class="input-number-increment"> <i class="ti-plus"></i></span>
                        </div>
                      </td>
                      <td>
                        <h5>${{$item->product->price * $item->Quantity}}</h5>
                      </td>
                    @endforeach
                    <tr class="bottom_button">
                      <td>
                        <a class="btn_1" href="#">Update Cart</a>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                      </td>
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
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="{{route('shop.products')}}">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="#">Proceed to checkout</a>
          </div>
          @endif
        </div>
      </div>
  </section>
  <!--================End Cart Area =================-->

  @endsection