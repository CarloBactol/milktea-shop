@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products List</h1>
        <a href="{{ url('/admin/add-product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add Product</a>
    </div>
    <table class="table table-bordered table-hover table-striped" id="tableID">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{!! Str::limit($item->description, 40)!!}</td>
                <td>
                    @if ($item->image == 'NULL')
                    <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="50" width="50"
                        class="rounded-circle">
                    @else
                    <img id="image" src="{{ asset('assets/products/'. $item->image) }}" alt="" height="50" width="50"
                        class="rounded-circle">
                    @endif

                </td>
                <td>
                    <a href="{{ url('/admin/edit-product/'.$item->id) }}" class="btn btn-sm btn-info"><i
                            class="fas fa-edit" aria-hidden="true"></i></a>
                    <a href="{{ url('/admin/delete-product/'.$item->id) }}" class="btn btn-sm btn-danger"><i
                            class="fas fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection