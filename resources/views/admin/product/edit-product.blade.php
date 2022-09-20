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
    <form method="post" action="{{ url('/admin/update-product/'.$products->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-md-6">
               <div class="row">
                <label for="qty">Stock</label>
                <input type="text" class=" mb-3 form-control @error('qty') is-invalid @enderror" name="qty" value="{{ $products->qty }}" autocomplete="qty" autofocus>
                @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="name">Name</label>
                <input id="name" type="text" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ $products->name }}" autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="name">Size</label>
                <select name="size_id" id="" class="form-control">
                    <option {{ $products->bottle_size == '0' ? 'selected' : '' }} value="0">Regular</option>
                    <option {{ $products->bottle_size == '1' ? 'selected' : '' }}  value="1">Large</option>
                </select>
                @error('size_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="image" class="mt-4">Image</label>
                <input id="image" type="file" name="image" class="form-control @error('image') is-invalid @enderror"  value="{{ old('image') }}" autocomplete="image" autofocus>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{ asset('assets/products/'. $products->image) }}" alt="" class="img-thumbnail">
               </div>
            </div>
            <div class="col-md-6">
                
                <label for="description">Description</label>
                <textarea  id="editor" class="form-control @error('description') is-invalid @enderror"  value="{{  $products->description  }}" name="description" id="floatingTextarea" cols="80" rows="15">
                {{ $products->description }}
                </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="status">Status</label>
                <input id="status"  type="checkbox" name="status" {{ $products->status == "1" ? 'checked' : '' }}>

                <label for="popular" class="ml-4">Popular</label>
                <input id="popular"  type="checkbox"  name="popular" {{ $products->popular == "1" ? 'checked' : '' }}>
                
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