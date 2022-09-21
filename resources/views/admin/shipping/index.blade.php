@extends('layouts.admin')

@section('dataTable-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
       <!-- Page Heading -->
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Shipping Fee List</h1>
        <a href="{{ url('/admin/add-shipping-fee') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Add Fee</a>
    </div>
    <table class="table" id="myTable">
        <thead>
            <th>ID</th>
            <th>Fee</th>
            <th>Action</th>
        </thead>
        @foreach ($shipping as $ship)
        <tbody>
            <tr>
                <td>{{ $ship->id }}</td>
                <td>&#8369;{{ $ship->shipping}}</td>
                <td>
                    <a href="{{ url('/admin/edit-shipping-fee/'.$ship->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit" aria-hidden="true"></i></a>
                    <a href="{{ url('/admin/delete-shipping-fee/'.$ship->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
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

