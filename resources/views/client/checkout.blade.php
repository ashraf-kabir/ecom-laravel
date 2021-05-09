
@extends('layouts.app')

@section('title')
  Checkout
@endsection

@section('content')

  <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
          <h1 class="mb-0 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 ftco-animate">

          {!!Form::open(['action' => 'App\Http\Controllers\CheckoutController@checkout', 'class' => 'checkout_form', 'method' => 'POST', 'id' => 'checkout_form', 'autocomplete' => 'off' ])!!}
          {{csrf_field()}}

            @if (Session::has('error'))
              <div class="alert alert-danger">
                {{Session::get('error')}}
                {{Session::put('error', null)}}
              </div>
            @endif

            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" autocomplete="off">
                </div>
              </div>
              <div class="w-100"></div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="state form-control" id="state" name="state" placeholder="" maxlength="2" minlength="2" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="country form-control" id="country" name="country" placeholder="" maxlength="2" minlength="2" autocomplete="off">
                </div>
              </div>
              <div class="w-100"></div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Street Address</label>
                  <input type="text" class="form-control" id="address_1" name="address_1" placeholder="Address line 1" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="address_2" name="address_2" placeholder="Address line 2" autocomplete="off">
                </div>
              </div>

              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">Town / City *</label>
                  <input type="text" name="city" id="city" class="form-control" placeholder="" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="zip">Postcode / ZIP *</label>
                  <input type="text" name="zip" id="zip" class="form-control" placeholder="" autocomplete="off">
                </div>
              </div>

              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="" autocomplete="off">
                </div>
              </div>

              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group mt-4">
                  <div class="radio">
                    <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                    <label><input type="radio" name="optradio"> Ship to different address</label>
                  </div>
                </div>
              </div>

            </div>

            <h3 class="mb-4 billing-heading">Card Details</h3>
            <div class="row align-items-end">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="card_name">Name on Card</label>
                  <input class="form-control" type="text" name="card_name" id="card_name">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="card_no">Card Number</label>
                  <input class="form-control" type="text" name="card_no" id="card_no">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="expire_at">Expiry Date</label>
                  <input class="form-control" type="text" name="expire_at" id="expire_at">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="card_name">CVC</label>
                  <input class="form-control" type="text" name="card_name" id="card_name">
                </div>
              </div>

            </div>
            
          {!!Form::close()!!}

        </div>

        <div class="col-xl-5">
          <div class="row mt-5 pt-3">
            <div class="col-md-12 d-flex mb-5">
              <div class="cart-detail cart-total p-3 p-md-4">
                <h3 class="billing-heading mb-4">Cart Total</h3>
                <p class="d-flex">
                  <span>Subtotal</span>
                  <span>$20.60</span>
                </p>
                <p class="d-flex">
                  <span>Delivery</span>
                  <span>$0.00</span>
                </p>
                <p class="d-flex">
                  <span>Discount</span>
                  <span>$3.00</span>
                </p>
                <hr>
                <p class="d-flex total-price">
                  <span>Total</span>
                  <span>${{Session::get('cart')->total_price}}</span>
                </p>
              </div>
            </div>

            {{-- <div class="col-md-12">
              <div class="cart-detail p-3 p-md-4">
                <h3 class="billing-heading mb-4">Payment Method</h3>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="radio">
                      <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="radio">
                      <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="radio">
                      <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="checkbox">
                      <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                    </div>
                  </div>
                </div>
                <p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
              </div>
            </div> --}}

          </div>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </section> <!-- .section -->


@endsection


@section('scripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('src/js/checkout.js') }}"></script>
<script>
  $(document).ready(function(){

  var quantitiy=0;
    $('.quantity-right-plus').click(function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      
      // If is not undefined
      
      $('#quantity').val(quantity + 1);
      // Increment
    });

    $('.quantity-left-minus').click(function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      
      // If is not undefined

      // Increment
      if(quantity>0){
      $('#quantity').val(quantity - 1);
      }
    });
  });
</script>
@endsection