@extends('layouts.frontend')

@section('title')
View Order
@endsection

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6">
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                <h3>User info</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="firstname">Firstname</label>
                        <input type="text" value={{ $orders->firstname }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastname">Lastname</label>
                        <input type="text" value={{ $orders->lastname }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" value={{ $orders->email }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" value={{ $orders->phone }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea cols="10" rows="2" class="form-control" disabled>{{ $orders->address }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" value={{ $orders->city }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" value={{ $orders->country }} class="form-control" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" value={{ $orders->postal_code }} class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    <h3>Order Details</h3>
                </div>
                <div class="card-body">
                    <table class="table  table-stripped">
                        <thead>
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
                                @foreach ($orders->order_items as $order)
                                    <tr>
                                        <td>
                                            @if ( $order->product->image == 'NULL')
                                                <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="50" width="50" class="rounded-circle">
                                            @else
                                            <img src="{{ asset('assets/products/'. $order->product->image) }}" alt="" height="50" width="50" class="rounded-circle">
                                            @endif
                                        </td>

                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->sugar_level }}%</td>
                                        @if (Auth::check())
                                            @forelse ($addOns as $add_ons)
                                                @if ($order->add_ons == $add_ons->id )
                                                <td>&#8369;{{  $add_ons->price }} {{ $add_ons->name ?? "" }}</td>
                                                @endif
                                            @empty                 
                                            @endforelse
                                        @endif
                                        <td>{{ $order->qty }} PCS</td>
                                        <td>&#8369;{{ $order->price  }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-info">
                                <tr>
                                    <td>Payment mode:</td>
                                    <td>{{ $orders->payment_mode }}</td>
                                    <td>Shipping Fee:</td>
                                    <td>&#8369;{{ $orders->shipping }}</td>
                                    <td >Grand Total:</td>
                                    <td >&#8369;{{ $orders->total_price }}</td>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection