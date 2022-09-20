@extends('layouts.frontend')

@section('title')
Shop
@endsection
@section('content')

<div class="container my-4">
    <br>
    <br>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3">
            <div class="card mb-2">
                @if ($product->image == 'NULL')
                <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="200px">
                @else
                <img src="{{asset('assets/products/'. $product->image) }}" alt="" height="200px">
                @endif
                <div class="card-body">
                    <h6>{{ $product->name }}</h6>
                    @if (Auth::check())
                        @forelse ($bottleSize as $bottle)
                            @if ($product->size_id == $bottle->size)
                            <span>&#8369;{{$bottle->price }}</span>
                            @endif
                         @empty
                        @endforelse
                    @endif
                    <p>{!! Str::limit($product->description, 50)!!}</p>
                    <hr>
                    <span>Stock: {{ $product->qty }} Pcs.</span>
                    <span class="float-end"><a href="{{ url('/view-product/'.$product->id) }}" class="btn btn-md btn-success px-3">Buy</a></span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection