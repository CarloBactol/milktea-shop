@extends('layouts.admin')
@section('content')
 <div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Shipping Fee</h1>
        <a href="{{ url('/admin/bottle-size') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
    </div>

    <!-- Page Form -->
    <form method="post" action="{{ url('/admin/store-shipping-fee')}}" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <div class="row ">
            <div class="col-md-6">
                <label for="shipping">Shipping Fee</label>
                <input id="shipping" type="number" class="form-control @error('price') is-invalid @enderror " name="shipping" value="{{ old('shipping') }}" autocomplete="shipping" autofocus>
                @error('shipping')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <button type="submit" class="btn btn-primary flex-start mt-4">Save</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
