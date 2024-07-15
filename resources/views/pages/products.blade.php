@extends('layouts.main')

@section('title', 'Products')

@section('content')

    <!-- breadcrumb part start-->
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>product list</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb part end-->
    
    <!-- product list part start-->
    <section class="product_list section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="product_sidebar">
                        <div class="single_sedebar">
                            <form action="{{route('search.index')}}">
                                <input type="text" name="query" placeholder="Search keyword">
                                <button type="submit" class="btn"></button>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="product_list">
                        <div class="row">
                            @foreach ($products as $product)
                                
                            <div class="col-lg-6 col-sm-6">
                                <div class="single_product_item">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                    <h3> <a href="{{route('products.show', $product->id)}}">{{ $product->name }}</a> </h3>
                                    <p>From ${{ $product->price}}</p>
                                </div>
                            </div>
                            @endforeach
    </section>
    <!-- product list part end-->
    

@endsection