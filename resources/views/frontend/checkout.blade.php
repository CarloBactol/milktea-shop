@extends('layouts.frontend')

@section('title')
Checkout
@endsection
@section('content')
@php
$ship_fee = 0;
$route = 0;
@endphp
@foreach ($shipping_fees as $ship)
<input type="hidden" value={{ $ship_fee=$ship->shipping }}>
@endforeach
<br>
<div class="container-fluid my-2">
    <br><br>
    <form action="{{ url('/place-order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- aside --}}
            <div class="col-md-5">

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
                                    <input type="text" name="address" id="from" onchange="calcRoute();"
                                        class="form-control address @error('address') is-invalid @enderror"
                                        value="{{ $getIp->city}}" placeholder="Enter address">
                                    <input type="hidden" id="to" value="Road 1 Talipapa, Caloocan City, Philippines">
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
                                        value="{{  $getIp->city}}" placeholder="Enter city">
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
                                        value="{{ $getIp->country   }}" placeholder="Enter country">
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
                <div class="card mt-4 mb-4" id="googleMap" style="max-width:100%; min-height: 300px">

                </div>
                <div id="output" class="my-3">

                </div>

            </div>

            {{-- aside --}}
            <div class="col-md-7">
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
                                    <td>Add-ons</td>
                                    <td>Fee</td>
                                    <td>Size</td>
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
                                @php
                                $add_ons = json_decode($cart->add_ons_id);
                                $total_add_ons = count($add_ons) * 10;
                                @endphp
                                <tr>
                                    <td>
                                        @if ($cart->product->image == 'NULL')
                                        <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="30px"
                                            width="30px" class="rounded-circle">
                                        @else
                                        <img src="{{ asset('assets/products/'. $cart->product->image) }}" alt=""
                                            height="30px" width="30px" class="rounded-circle">
                                        @endif

                                    </td>

                                    <td>{{ $cart->product->name}}</td>
                                    <td>{{ $cart->sugar_level}}%</td>
                                    <td>
                                        @foreach ($add_ons as $addon)
                                        @if ($addon> 0)
                                        @foreach ($addons as $add)
                                        {{ $addon == $add->id ? $add->name. ",": ""
                                        }}
                                        @endforeach
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>₱{{ $total_add_ons }}</td>
                                    <td>
                                        @if($cart->bottle->size == 0)
                                        Small
                                        @elseif ($cart->bottle->size == 1)
                                        Meduim
                                        @else
                                        Large
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $cart->product_qty}}</td>
                                    <td>{{
                                        $cart->bottle_size_id == $cart->bottle->id ?
                                        '₱'.$cart->bottle->price :
                                        ""
                                        }}
                                    </td>
                                </tr>
                                {{-- Compute total --}}
                                @php
                                $sum_of_price_and_add_ons = $cart->bottle->price + $total_add_ons;
                                $total += $sum_of_price_and_add_ons * $cart->product_qty;
                                $total_wfee = $total + $ship_fee;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr class="bg-success text-light">
                                    <td colspan="3">
                                        <input type="hidden" value="{{ $ship_fee }}" class="shipping" name="shipping">
                                        <input type="hidden" value="{{ $total_wfee }}" class="total_price"
                                            name="total_price">
                                        <h5>Shipping Fee: <span id="ship-count">{{ $ship_fee }}</span>
                                        </h5>
                                    </td>
                                    <td colspan="4" style="text-align: end">
                                        <h5>Grand Total: <span id="grand-total">&#8369;{{ $total_wfee}}</span></h5>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-primary my-2 p-3 mb-3 w-100">Place
                            Order
                            |
                            COD</button>
                        <div id="paypal-button-container"></div>
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

{{-- MAPS --}}
<script>
    //set map options
                var myLatLng = { lat: 11.112666, lng: 122.509476 };
                var mapOptions = {
                    center: myLatLng,
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    types: ['address']
                
                };
    
                //create map
                var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
                
                //create a DirectionsService object to use the route method and get a result for our request
                var directionsService = new google.maps.DirectionsService();
                
                //create a DirectionsRenderer object which we will use to display the route
                var directionsDisplay = new google.maps.DirectionsRenderer();
                
                //bind the DirectionsRenderer to the map
                directionsDisplay.setMap(map);
    
    
                //define calcRoute function
                function calcRoute() {

                            // load cart-count
                            loadCart();
                            // load grand_total
                            loadTotal() 

                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                },
                            });
                                // load shipping-count
                                function loadCart() {
                                $.ajax({
                                    type: "GET",
                                    url: "/load-shipping-data",
                                    success: function (response) {
                                        $("#ship-count").html("");
                                        $("#ship-count").html(response.count);
                                        // alert(response.count);
                                    },
                                });
                            }

                             // load grand-total-count
                             function loadTotal() {
                                $.ajax({
                                    type: "GET",
                                    url: "/load-grand-total-data",
                                    success: function (response) {
                                        $("#grand-total").html("");
                                        $("#grand-total").html(response.count);
                                        // alert(response.count);
                                    },
                                });
                            }


                    //create request
                    var request = {
                        origin: document.getElementById("from").value,
                        destination: document.getElementById("to").value,
                        travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
                        unitSystem: google.maps.UnitSystem.IMPERIAL
                    }
                
                    //pass the request to the route method
                    directionsService.route(request, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                
                        var distance = result.routes[0].legs[0].distance.text;
                            // csrf token
                            console.log(distance);
                        $.ajax({
                            type: "POST",
                            url: "/distance",
                            data: {
                                "distance": distance,
                            },
                            success: function (response) {
                                loadCart();
                                loadTotal()
                                swal({
                                title: 'New Address Added!',
                                icon: "success",
                                timer: 3000
                            });             
                            }
                            });
                            //Get distance and time
                            const output = document.querySelector('#output');
                            output.innerHTML = "<div class='alert-info'>From Shop: " + document.getElementById("to").value.toUpperCase() + ".<br />To Customer: " + document.getElementById("from").value.toUpperCase() + ".<br /> Driving distance <i class='fas fa-road'></i> : " + result.routes[0].legs[0].distance.text + ".<br />Duration <i class='fas fa-hourglass-start'></i> : " + result.routes[0].legs[0].duration.text + ".</div>";
                
                            //display route
                            directionsDisplay.setDirections(result);
                        } else {
                            //delete route from map
                            directionsDisplay.setDirections({ routes: [] });
                            //center map in London
                            map.setCenter(myLatLng);
                
                            //show error message
                            output.innerHTML = "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Could not retrieve driving distance.</div>";
                        }
                    });
                
                }
    
    
    
                //create autocomplete objects for all inputs
                var options = {
                    types: ['geocode']
                }
    
                var input1 = document.getElementById("from");
                var autocomplete1 = new google.maps.places.Autocomplete(input1, options);
                
                var input2 = document.getElementById("to");
                var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
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
                                value: '{{ $total_wfee }}'
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
                                var shipping = $(".shipping").val();
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
                                        "shipping": shipping,
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