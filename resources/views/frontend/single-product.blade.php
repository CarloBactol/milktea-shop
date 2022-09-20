@extends('layouts.frontend')

@section('title')
View Product
@endsection

@section('content')
<div class="container">
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5"  id="product_data"> 
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                @if ($products->image == 'NULL')
                    <img src="{{ asset('assets/products/1.jpg') }}" alt="" class="w-100">
                  @else
                  <img src="{{asset('assets/products/'. $products->image) }}" alt="" class="w-100">
                  @endif
                </div>
                <div class="col-md-6">
                    <input type="hidden" value="{{ $products->id }}" id="prod_id">
                    <h1 class="display-5 fw-bolder">{{ $products->name }}</h1>
                    <p class="lead">{!! $products->description !!}</p>
                    <hr>
                    <div class="d-flex">
                        <h6 class="text-secondary me-4">Bottle Cups</h6>
                        <select name="bottle_size" id="bottle_size" class="form-control">                          
                            @foreach ($sizes as $size)
                                @if ($size->size == '0')
                                <option value="{{ $size->price }}">&#8369;{{ $size->price }} Regular</option>
                                @else
                                <option value="{{ $size->price }}">&#8369;{{ $size->price }} Large</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="text-secondary me-4">Sugar Level</h6>
                        <select name="sugar_level" id="sugar_level" class="form-control">
                            <option value="0">0%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                            <option value="75">75%</option>
                            <option value="100">100%</option>
                        </select>
                    </div>
                    <hr>
                    <h6 class="text-secondary">Add-ons:</h6>            
                    <div>
                        <select name="add_ons" id="add_ons_id" class="form-control">
                            @foreach ($sinkers as $sink)
                            <option value="{{ $sink->id }}">{{ $sink->name }} | &#8369; {{ $sink->price }}</option>
                            @endforeach
                        </select>
                    </div>                                           
                    <hr>
                    <h6>Quantity</h6>
                    <div class="d-flex">
                        @if($products->qty > 0 )
                        <button type="button" id="decrement" class=" btn btn-outline-secondary">-</button>
                        <input class="form-control text-center" id="product_qty" type="num" value="1" style="max-width: 3rem" />
                        <button type="button" id="increment" class=" btn btn-outline-secondary me-2">+</button>
                        <button id="btn-cart" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>

                        @else
                            <span class="text-danger me-4">Sorry not available. Out of Stock!</span> 
                            <a href="{{ url('/shop') }}" class="btn btn-sm btn-primary">Find Another Products!</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
