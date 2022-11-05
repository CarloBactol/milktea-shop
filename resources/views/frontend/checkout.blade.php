@extends('layouts.frontend')

@section('title')
Checkout
@endsection
@section('content')
@php
$ship_fee = 0;
$ship_user_id = 0;
$route = 0;
@endphp
@foreach ($shipping_fees as $ship)
<input type="hidden" value={{ $ship_fee=$ship->shipping }}>
<input type="hidden" value={{ $ship_user_id=$ship->user_id }}>
@endforeach
<br>
<div class="container-fluid my-2">
    <br><br>
    <form action="{{ url('/address') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- aside --}}
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header">
                        <h4>Select Address</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="adrress">Adrress</label>
                                    <input type="hidden" value="{{ Auth::user()->email; }}" id="email">
                                    <input type="text" name="address" id="from" onchange="calcRoute();"
                                        class="form-control address @error('address') is-invalid @enderror"
                                        value="{{ Auth::user()->address }}" placeholder="Enter address">
                                    <input type="hidden" id="to" value="San Leonardo, Nueva Ecija, Philippines">
                                    <small class="text-danger address_err"></small>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
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
                                        {{-- From json_decode() --}}
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
                                    <td colspan="8" style="text-align: center;">
                                        <input type="hidden" value="{{ $ship_fee }}" class="shipping" name="shipping">
                                        <input type="hidden" id="#input-id" value="{{ $total_wfee }}"
                                            class="total_price" name="total_price">
                                        <h5> Shipping Fee: <span id="ship-count">{{
                                                Auth::user()->id == $ship_user_id ?
                                                $ship_fee : 0 }}</span>
                                        </h5>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">Confirm Address</button>
                        {{-- <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-primary my-2 p-3 mb-3 w-100">Place
                            Order
                            |
                            COD</button>
                        <div id="paypal-button-container"></div> --}}
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
                        url: "/load-shipping-data",
                        success: function (response) {
                            $("#grand-total").html("");
                            $("#grand-total").html(response.total);
                            // alert(response.count);
                        },
                    });
                }

                // input grand_total
                // $("#input-id").on("change keyup paste", function(){
                //     hekki
                // })

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
             var email = $('#email').val(); 
            $.ajax({
                type: "POST",
                url: "/distance",
                data: {
                    "distance": distance,
                    'email': email,
                },
                success: function (response) {
                    loadCart();
                    loadTotal()
                    swal({
                    title: 'New Shipping Fee!',
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

@endsection