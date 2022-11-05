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
                            <tr class="text-center">
                                <td>Trace ID</td>
                                <td>Status</td>
                                <td>Order Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->tracking_no }}</td>
                                <td>
                                    @if ($order->status == '0')
                                    <button class="btn btn-sm btn-warning" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Pending...
                                    </button>
                                    @elseif ($order->status == '1')
                                    <button class="btn btn-sm btn-info" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Processing...
                                    </button>
                                    @elseif ($order->status == '2')
                                    <button class="btn btn-sm btn-success" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                        <i class="fas fa-shipping-fast"></i> Shipping
                                    </button>
                                    @elseif ($order->status == '3')
                                    <button class="btn btn-sm btn-success" type="button" disabled>
                                        <i class="fas fa-check"></i>
                                        Completed
                                    </button>
                                    @endif
                                </td>
                                <td>{{ $order->updated_at->diffForHumans(); }}</td>
                                <td><a href="{{ url('/view-order/'.$order->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-eye"></i></a></td>
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