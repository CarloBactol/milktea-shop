@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Sinker</h1>
        <a href="{{  route('premium_sizes.index')  }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
    </div>

    <!-- Page Form -->
    <form method="post" action="{{ route('premium_sizes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="row ">
                <div class="col-md-6">
                    <label for="size">Bottle Size</label>
                    <select name="size" id="size" class="form-control mb-4 @error('size') is-invalid @enderror ">
                        <option value="0">Regular</option>
                        <option value="1">Meduim</option>
                        <option value="2">Large</option>
                    </select>
                    @error('size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="price">Price</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror "
                        name="price" value="{{ old('price') }}" autocomplete="price" autofocus>
                    @error('price')
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