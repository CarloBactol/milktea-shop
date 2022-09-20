@extends('layouts.admin')

@section('dataTable-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Orders</h1>
        <a href="{{ url('/admin/order-history') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-history fa-sm text-white-50"></i> Orders History</a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="myTable">
        <thead>
            <tr>
                <th>Trace No</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($orders as $order)
        <tbody>
            <tr>
                <td>{{ $order->tracking_no }}</td>
                <td>{{ $order->total_price }}</td>
                <td>
                    @if ($order->status == '0')
                    <span class="text-warning">Pending</span>
                    @else
                    <span class="text-success">Completed</span>
                    @endif
                </td>
                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                <td class="text-center">
                    <a href="{{ url('/admin/view-order/'.$order->id) }}" class="btn btn-sm btn-info"><i
                            class="fas fa-edit"></i></a>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

@endsection

@section('dataTable-js')
<script src="http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
         $('#myTable').DataTable();
    } );
</script>
@endsection