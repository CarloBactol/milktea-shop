@extends('layouts.frontend')

@section('title')
Checkout
@endsection

@section('content')
@php $ship_fee = 0; @endphp
@foreach ($shipping_fees as $ship)
    <input type="hidden" value="{{  $ship_fee += $ship_fee + $ship->shipping; }}">
@endforeach
<div class="container my-4">
    <br><br>
    <form action="{{ url('/place-order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4>Basic Details</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname"
                                        class="form-control firstname  @error('firstname') is-invalid @enderror"
                                        value="{{  Auth::user()->firstname }}" placeholder="Enter Firstname">
                                    <small class="text-danger fname_err"></small>
                                    @error('firstname')
                                    <span class="invalid-feedback fname_err" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname"
                                        class="form-control lastname  @error('lastname') is-invalid @enderror"
                                        value="{{ Auth::user()->lastname }}" placeholder="Enter lastname">
                                    <small class="text-danger lname_err"></small>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control email @error('email') is-invalid @enderror"
                                        value="{{ Auth::user()->email }}" placeholder="Enter email">
                                    <small class="text-danger email_err"></small>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone"
                                        class="form-control phone  @error('phone') is-invalid @enderror"
                                        value="{{  Auth::user()->phone  }}" placeholder="Enter phone">
                                    <small class="text-danger phone_err"></small>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adrress">Adrress</label>
                                    <input type="text" name="address"
                                        class="form-control address @error('address') is-invalid @enderror"
                                        value="{{  Auth::user()->address }}" placeholder="Enter address">
                                    <small class="text-danger address_err"></small>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city"
                                        class="form-control city  @error('city') is-invalid @enderror"
                                        value="{{  Auth::user()->city }}" placeholder="Enter city">
                                    <small class="text-danger city_err"></small>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country"
                                        class="form-control  country @error('country') is-invalid @enderror"
                                        value="{{  Auth::user()->country  }}" placeholder="Enter country">
                                    <small class="text-danger country_err"></small>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code"
                                        class="form-control postal_code @error('postal_code') is-invalid @enderror"
                                        value="{{ Auth::user()->postal_code }}" placeholder="Enter Postal Code">
                                    <small class="text-danger postal_code_err"></small>
                                    @error('postal_code')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Order Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Sugar</td>
                                    <td>Addons</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sum_of_price_add_ons = 0;
                                $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                <tr>
                                    <td>
                                        @if ($cart->product->image == 'NULL')
                                        <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="30px" width="30px" class="rounded-circle">
                                        @else
                                        <img src="{{ asset('assets/products/'. $cart->product->image) }}" alt=""
                                            height="30px" width="30px" class="rounded-circle">
                                        @endif
            
                                    </td>
                                    <td>{{ $cart->product->name}}</td>
                                    <td>{{ $cart->sugar_level}}%</td>
                                    <td>{{ $cart->addOns->name }}</td>
                                    <td>{{ $cart->product_qty}}</td>
                                    <td>&#8369;{{ $cart->bottle_size }}</td>
                                </tr>

                                @php
                                $sum = $cart->bottle_size + $cart->addOns->price;
                                $total +=  $sum * $cart->product_qty +  $ship_fee ;
                                @endphp
                                {{-- <td>{{ dd($sum) }}</td> --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-info">
                                    <td>Shipping Fee:</td>
                                    <td>&#8369;{{ $ship_fee }}</td>
                                    <td></td>
                                    <td> Grand Total: </td>
                                    <input type="text" value="{{ $ship_fee }}" class="shipping" name="shipping">
                                    <input type="hidden" value="{{ $total}}" class="total_price" name="total_price">
                                    <td colspan="2"><span>&#8369;{{ $total  ?? "" }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <input type="hidden" name="payment_mode" value="COD">
                                        <button type="submit" class="btn btn-primary my-2 p-3 mb-3 w-100">Place Order |
                                            COD</button>
                                        <div id="paypal-button-container"></div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script async
    src="https://www.paypal.com/sdk/js?client-id=AS_P97I6oXyQOll8MMkVUu2yipE-8fEb4pO9nyX-yUzjweJ9_9Jc7-jWbkHrFaOVb_tAtYTuRNHn3-es&currency=PHP">
</script>
<script>
    // wait for on load event to ensure the JS SDK is loaded
    window.addEventListener('load', (event) => {
      var options = {
        createOrder: function(data, actions) {
          // This function sets up the details of the transaction, including the amount and line item details. 
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{ $total }}'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          // This function captures the funds from the transaction. 
          return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer. 
            // alert('Transaction completed by ' + details.payer.name.given_name);

            var firstname = $(".firstname").val();
            var lastname = $(".lastname").val();
            var email = $(".email").val();
            var phone = $(".phone").val();
            var address = $(".address").val();
            var city = $(".city").val();
            var country = $(".country").val();
            var postal_code = $(".postal_code").val();
            var shipping_fee = $(".shipping").val();
            var total_price = $(".total_price").val();
            $.ajax({
                type: "POST",
                url: "/place-order",
                data: {
                    "firstname": firstname,
                    "lastname": lastname,
                    "email": email,
                    "phone": phone,
                    "address": address,
                    "city": city,
                    "country": country,
                    "postal_code": postal_code,
                    "payment_mode": "Paid by Paypal",
                    "payment_id": details.id,
                    "shipping_fee": shipping_fee,
                    "total_price": total_price,
                },
                success: function (response) {
                    swal({
                    title: response.status,
                    icon: "success",
                    timer: 3000
                }).then(function() {
                    window.location.href = "/my-order";
                });              
                }
            });
          })
        }
      };
      // This function displays Smart Payment Buttons on your web page. 
      window.paypal.Buttons(options).render('#paypal-button-container');
    });
</script>
@endsection