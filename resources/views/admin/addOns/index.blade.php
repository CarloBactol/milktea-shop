@extends('layouts.admin')

@section('dataTable-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
 <div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sinkers List</h1>
        <a href="{{ url('/admin/add-sinker') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Add Sinkers</a>
    </div>
    <table class="table" id="myTable">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </thead>
        @foreach ($sinkers as $item)
        <tbody>
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ url('/admin/edit-sinker/'.$item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit" aria-hidden="true"></i></a>
                    <a href="{{ url('/admin/delete-sinker/'.$item->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
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
