@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1>Best quality
                                pillow</h1>
                            <p>Seamlessly empower fully researched 
                                growth strategies and interoperable internal</p>
                            <a href="{{route('shop.products')}}" class="btn_1">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner_img">
            <img src="img/banner.png" alt="#" class="img-fluid">
            <img src="img/banner_pattern.png " alt="#" class="pattern_img img-fluid">
        </div>
    </section>
    <!-- banner part start-->

    <!-- trending item start-->
    <section class="trending_items">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Trending Items</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    
                <div class="col-lg-4 col-sm-6">
                    <div class="single_product_item">
                        <div class="single_product_item_thumb">
                            <img src="{{ asset('storage/'. $product->image) }}" alt="#" class="img-fluid">
                        </div>
                        <h3> <a href="{{route('products.show', $product->id)}}">{{ $product->name }}</a> </h3>
                        <p>From ${{ $product->price }}</p>
                    </div>
                </div>
                @endforeach
   </section>
    <!-- trending item end-->   

@endsection