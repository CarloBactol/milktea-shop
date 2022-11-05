@extends('layouts.admin')


@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Sinker</h1>
        <a href="{{ url('/admin/bottle-size') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
    </div>

    <!-- Page Form -->
    <form method="post" action="{{ url('/admin/update-bottle-size/'.$sizes->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="row ">
                <div class="col-md-6">
                    <label for="size">Bottle Size</label>
                    <select name="size" id="size" class="form-control mb-4 @error('size') is-invalid @enderror ">
                        <option value="0" {{ $sizes->size == 0 ? 'selected' : ''}}>Regular</option>
                        <option value="1" {{ $sizes->size == 1 ? 'selected' : ''}}>Medium</option>
                        <option value="2" {{ $sizes->size == 2 ? 'selected' : ''}}>Large</option>
                    </select>
                    @error('size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="price">Price</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror "
                        name="price" value="{{ $sizes->price}}" autocomplete="price" autofocus>
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