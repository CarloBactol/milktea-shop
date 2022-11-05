@extends('layouts.admin')


@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
        <a href="{{ url('/admin/product-list') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
    </div>

    <!-- Page Form -->
    <form method="post" action="{{ url('/admin/store-product')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">

                        <label for="name">Name</label>
                        <input id="name" type="text" class=" mb-3 form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label for="name">Size</label>
                        <select name="size_id" id="" class="form-control">
                            @foreach ($sizes as $items)
                            @if ($items->size == '0')
                            <option value="{{ $items->id }}">Small</option>
                            @elseif ($items->size == '1')
                            <option value="{{ $items->id }}">Meduim</option>
                            @else
                            <option value="{{ $items->id }}">Large</option>
                            @endif
                            @endforeach
                        </select>
                        @error('size_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label for="name" class="mt-3">Categories</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('Categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label for="image" class="mt-4">Image</label>
                        <input id="image" type="file" name="image"
                            class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}"
                            autocomplete="image" autofocus>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="col-md-6">

                    <label for="description">Description</label>
                    <textarea id="editor" class="form-control @error('description') is-invalid @enderror"
                        value="{{ old('description') }}" name="description" id="floatingTextarea" cols="80"
                        rows="15"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group mt-4">

                    <label for="status">Status</label>
                    <input id="price" type="checkbox" class=" mr-4 @error('status') is-invalid @enderror" name="status">
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="popular">Popular</label>
                    <input id="price" type="checkbox" class=" @error('popular') is-invalid @enderror" name="popular">
                    @error('popular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <button type="submit" class="btn btn-primary ml-4">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('ck-editor')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection