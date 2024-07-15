@extends('layouts.main')

@section('title', 'confirmation')

@section('content')

<!-- breadcrumb part start-->
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>confirmation</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!--================ confirmation part start =================-->
<section class="confirmation_part section_padding">
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="confirmation_tittle">
        <span>Thank you. Your order has been received.</span>
      </div>
    </div>
    <div class="col-lg-6 col-lx-4">
      <div class="single_confirmation_details">
        <h4>order info</h4>
        <ul>
          <li>
            <p>order number</p><span>: {{$order->id}}</span>
          </li>
          <li>
            <p>date</p><span>:{{date('d-m-Y', strtotime($shipDetails->created_at))}}</span>
          </li>
          <li>
            <p>total</p><span>: USD {{$order->total}}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-6 col-lx-4">
      <div class="single_confirmation_details">
        <h4>Billing Address</h4>
        <ul>
          <li>
            <p>Street</p><span>: {{$shipDetails->address1}}</span>
          </li>
          <li>
            <p>city</p><span>: {{$shipDetails->city}}</span>
          </li>
          <li>
            <p>country</p><span>: {{$shipDetails->country}} </span>
          </li>
          <li>
            <p>postcode</p><span>: {{$shipDetails->zip_code}}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="order_details_iner">
        <h3>Order Details</h3>
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col" colspan="2">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orderItems as $item )
            <tr>
              <th colspan="2"><span>{{$item->product->name}}</span></th>
              <th>x{{$item->Quantity}}</th>
              <th> <span>${{$item->price * $item->Quantity}}</span></th>
            </tr>
            @endforeach
            <tr>
              <th colspan="3">Subtotal</th>
              <th> <span>${{$subtotal}}</span></th>
            </tr>
            <tr>
              <th colspan="3">shipping</th>
              <th><span>flat rate: $50.00</span></th>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th scope="col" colspan="3">Total</th>
              <th scope="col">${{$subtotal + 50}}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
</section>
<!--================ confirmation part end =================-->
@endsection