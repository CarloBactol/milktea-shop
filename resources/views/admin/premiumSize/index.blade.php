@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Premium size</h1>
        <a href="{{ route('premium_sizes.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add Size</a>
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
                    @foreach ($premiumSize as $item)
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
                        <td class="row">
                            <a href="{{url('premium_sizes/'.$item->id. '/edit') }}" class="btn btn-sm btn-info mr-2"><i
                                    class="fas fa-edit" aria-hidden="true"></i></a>
                            <form action="{{ url('premium_sizes/'.$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"
                                        aria-hidden="true"></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection