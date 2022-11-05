@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders History</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-8">
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
                                    <td>Additional Fee</td>
                                    <td>Size</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($orders->order_items as $order)
                            <tr>
                                <td>
                                    @if ( $order->product->image == 'NULL')
                                    <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="50" width="50"
                                        class="rounded-circle">
                                    @else
                                    <img src="{{ asset('assets/products/'. $order->product->image) }}" alt=""
                                        height="50" width="50" class="rounded-circle">
                                    @endif
                                </td>

                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->sugar_level }}%</td>
                                <td>
                                    @php
                                    $order_addons = json_decode($order->add_ons);
                                    $tota_fee_addons = count($order_addons) * 10;
                                    @endphp
                                    {{-- loops the data from order_addons --}}
                                    @foreach ($order_addons as $decode_addons)
                                    {{-- check if there is addons --}}
                                    @if ($order_addons > 0)
                                    @foreach ($addOns as $table_addons)
                                    {{ $decode_addons == $table_addons->id ? "$table_addons->name" : ""}}
                                    @endforeach
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    &#8369;{{ $tota_fee_addons }}
                                </td>

                                <td>
                                    @if ($order->product->bottle->size == 0)
                                    Small
                                    @elseif ($order->product->bottle->size == 1)
                                    Meduim
                                    @elseif ($order->product->bottle->size == 2)
                                    Large
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->qty }}</td>
                                <td>&#8369;{{ $order->product->bottle->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-success text-dark text-lg">
                            <tr>
                                <td colspan="2">Payment mode:</td>
                                <td>{{ $orders->payment_mode }}</td>
                                <td colspan="1">Shipping Fee:</td>
                                <td>&#8369;{{ $orders->shipping > 0 ? $orders->shipping : 0}}</td>
                                <td colspan="2">Grand Total:</td>
                                <td>&#8369;{{ $orders->total_price}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ url('/admin/update-order/'.$orders->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option {{ $orders->status == '0' ? 'selected' : '' }} value="0">Pending</option>
                                <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">Processing</option>
                                <option {{ $orders->status == '2' ? 'selected' : '' }} value="2">Shipping</option>
                                <option {{ $orders->status == '3' ? 'selected' : '' }} value="3">Completed</option>
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
                </form>
            </div>
        </div>


    </div>
    @endsection