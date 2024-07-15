@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
<!-- breadcrumb part start-->
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>checkout</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--================Checkout Area =================-->
<section class="checkout_area section_padding">
<div class="container">
  
  <div class="billing_details">
    <div class="row">
      <div class="col-lg-8">
        <h3>Billing Details</h3>
        <form action="{{ route('checkout.store') }}" method="POST" class="row contact_form" >
            @csrf
            @method('POST')
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control" id="first" name="fname" placeholder="First name" required/>
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control" id="last" name="lname" placeholder="Last name" required />
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control" id="number" name="phone" placeholder="Phone number" required />
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required />
          </div>
          <div class="col-md-12 form-group p_star">
            <select class="country_select" name="country" required>
              <option value="Egypt">Egypt</option>
              <option value="Jordan">Jordan</option>
              <option value="Iraq">Iraq</option>
            </select>
          </div>
          <div class="col-md-12 form-group p_star">
            <input type="text" class="form-control" id="add1" name="address1" placeholder="Address line 01"  required/>
          </div>
          <div class="col-md-12 form-group p_star">
            <input type="text" class="form-control" id="add2" name="address2" placeholder="Address line 02" />
          </div>
          <div class="col-md-12 form-group p_star">
            <input type="text" class="form-control" id="city" name="city" placeholder="Town/City" required/>
          </div>
          <div class="col-md-12 form-group">
            <input type="text" class="form-control" id="zip" name="zip_code" placeholder="Postcode/ZIP" required/>
          </div>
          <div class="col-md-12 form-group">
            <textarea class="form-control" name="notes" id="message" rows="1"
              placeholder="Order Notes"></textarea>
          </div>
          <button type="submit" style="width: 100%;" class="btn_3">Proceed</button>
        </form>
      </div>
      <div class="col-lg-4">
        <div class="order_box">
          <h2>Your Order</h2>
          <ul class="list">
            <li>
              <a href="#">Product
                <span>Total</span>
              </a>
            </li>
            @foreach ($orderItems as $orderitem)
            <li>
              <a href="#">{{$orderitem->product->name}}
                <span class="middle">x{{$orderitem->Quantity}}
                </span>
                <span class="last">${{$orderitem->price * $orderitem->Quantity}}</span>
              </a>
            </li>
            @endforeach
          </ul>
          <ul class="list list_2">
            <li>
              <a href="#">Subtotal
                <span>${{$total}}</span>
              </a>
            </li>
            <li>
              <a href="#">Shipping
                <span>Flat rate: $50.00</span>
              </a>
            </li>
            <li>
              <a href="#">Total
                <span>${{$total + 50}}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!--================End Checkout Area =================-->
@endsection