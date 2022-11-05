@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Regular size </h1>
        <a href="{{ url('/admin/add-bottle-size') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add Product</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-bordered table-hover table-striped" id="tableID">
                <thead>
                    <th>ID</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($sizes as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            @if ($item->size == '0')
                            <span>Regular</span>
                            @elseif ($item->size == '1')
                            <span>Meduim</span>
                            @elseif ($item->size == '2')
                            <span>Large</span>
                            @endif
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <a href="{{ url('/admin/edit-bottle-size/'.$item->id) }}" class="btn btn-sm btn-info"><i
                                    class="fas fa-edit" aria-hidden="true"></i></a>
                            <a href="{{ url('/admin/delete-bottle-size/'.$item->id) }}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection