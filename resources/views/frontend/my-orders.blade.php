@extends('layouts.frontend')

@section('title')
My Orders
@endsection

@section('content')
<div class="container my-4">
    <br>
    <br>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Trace ID</td>
                                <td>Total</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->tracking_no }}</td>
                                    <td>&#8369; {{ $order->total_price }}</td>
                                    <td>
                                        @if ($order->status == '0')
                                            <span class="text-warning">Pending</span>
                                            @else
                                            <span class="text-success">Completed</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/view-order/'.$order->id) }}" class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection