@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders List</h1>
        <a href="{{ url('/admin/order-history') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-history fa-sm text-white-50"></i> Orders History</a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tableID">
        <thead>
            <tr>
                <th>Trace No</th>
                <th>Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->tracking_no }}</td>
                <td>{!! Str::upper($order->firstname) ." " . Str::upper($order->lastname) !!}</td>
                <td>&#8369;{{ $order->total_price }}</td>
                <td>
                    @if ($order->status == '0')
                    <button class="btn btn-sm btn-warning" type="button" disabled>
                        <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
                        Pending...
                    </button>
                    @elseif ($order->status == '1')
                    <button class="btn btn-sm btn-info" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </button>
                    @elseif ($order->status == '2')
                    <button class="btn btn-sm btn-success" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        <i class="fas fa-shipping-fast"></i> Shipping
                    </button>
                    @elseif ($order->status == '3')
                    <button class="btn btn-sm btn-success" type="button" disabled>
                        Completed
                    </button>
                    @endif
                </td>
                <td>{!! $order->created_at->diffForHumans() !!}</td>
                <td class="text-center">
                    <a href="{{ url('/admin/view-order/'.$order->id) }}" class="btn btn-sm btn-info"><i
                            class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('script')
<script src="{{ asset('admin/js/datatable-jquery.js') }}"></script>
<script type="text/JavaScript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    var table = $('#tableID').DataTable({
            serverSide: false,
            processing: true, // for show progress bar
            filter: true, // this is for disable filter (search box)
            orderMulti: false, // for disable multiple column at once
            paging: true,
            scrollY: 250,
            keys: true,
            scroller: {
                loadingIndicator: true
            },
            
            searching: true // enable search bar
        });
    });


</script>

@endpush