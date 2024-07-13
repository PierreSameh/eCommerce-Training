@extends('layouts.main')

@section('title')
{{$product->name}}
@endsection
@section('content')

<!-- breadcrumb part start-->
<section class="breadcrumb_part single_product_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!--================Single Product Area =================-->
<div class="product_image_area">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="product_img_slide owl-carousel">
        <div class="single_product_img">
          <img src="{{asset('storage/'. $product->image)}}" alt="#" class="img-fluid">
        </div>
        <div class="single_product_img">
          <img src="{{asset('storage/'. $product->image)}}" alt="#" class="img-fluid">
        </div>
        <div class="single_product_img">
          <img src="{{asset('storage/'. $product->image)}}" alt="#" class="img-fluid">
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="single_product_text text-center">
        <h3>{{$product->name}}</h3>
        <p>{{$product->description}}</p>
        <p>${{$product->price}}</p>
        <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        @if (auth()->id())
        <input type="hidden" name="cart_id" value="{{$cart->cart_id}}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif
        <div class="card_area">
          <div class="product_count_area">
              <p>Quantity</p>
              <div class="product_count d-inline-block">
                  <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                  <input class="product_count_item input-number" type="text" value="1" min="0" max="10" name="Quantity">
                  <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
              </div>
          </div>
          <div class="add_to_cart">
        <button type="submit" class="btn btn-primary">Add to Cart</button>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--================End Single Product Area =================-->

@endsection