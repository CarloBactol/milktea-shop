@extends('layouts.frontend')

@section('title')
View Product
@endsection

@section('content')
<div class="container">
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5" id="product_data">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    @if ($products->image == 'NULL')
                    <img src="{{ asset('assets/products/1.jpg') }}" alt="{{ $products->name }}" class="w-100">
                    @else
                    <img src="{{asset('assets/products/'. $products->image) }}" alt="{{ $products->name }}"
                        class="w-100">
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="POST" id="add-on">
                        <input type="hidden" value="{{ $products->id }}" id="prod_id">
                        <h1 class="display-5 fw-bolder">{{ $products->name }}</h1>
                        @if ($products->category_id == 2)
                        <span class="badge bg-danger"> <i class="fa fa-fire"></i> Premuim</span>
                        @elseif ($products->category_id == 3)
                        <span class="badge bg-success">Best Seller</span>
                        @elseif ($products->category_id == 1)
                        <span class="badge bg-primary">Regular</span>
                        @else
                        <span class="badge bg-primary">Regular</span>
                        @endif

                        <p class="lead">{!! $products->description !!}</p>
                        <hr>
                        <div class="d-flex">
                            <h6 class="text-secondary me-4">Bottle Cups</h6>
                            <select name="bottle_size" id="bottle_size" class="form-control">
                                @if ($products->category_id == '2')
                                @foreach ($premiumBottle as $prem)
                                @if ($prem->size == '0')
                                <option value="{{ $prem->id }}">&#8369;{{ $prem->price }} Regular</option>
                                @elseif ($prem->size == '1')
                                <option value="{{ $prem->id }}">&#8369;{{ $prem->price }} Meduim</option>
                                @elseif ($prem->size == '2')
                                <option value="{{ $prem->id }}">&#8369;{{ $prem->price }} Large</option>
                                @endif
                                @endforeach
                                @else

                                @foreach ($sizes as $size)
                                @if ($size->size == '0')
                                <option value="{{ $size->id }}">&#8369;{{ $size->price }} Regular</option>
                                @elseif ($size->size == '1')
                                <option value="{{ $size->id }}">&#8369;{{ $size->price }} Meduim</option>
                                @elseif ($size->size == '2')
                                <option value="{{ $size->id }}">&#8369;{{ $size->price }} Large</option>
                                @else
                                ""
                                @endif
                                @endforeach
                                @endif
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

                            @if($products->category_id == '2')
                            <input type="hidden" value="2" id="category_id">
                            @foreach ($premiumAddOn as $premAdd)
                            <label for="{{ $premAdd->name }}">{{ $premAdd->name }}</label>
                            <input type="checkbox" class=" @error('name') is-invalid @enderror"
                                value="{{ $premAdd->id }}" id="add_ons_id" name="addons[]" /> ||
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @endforeach

                            @else

                            @foreach ($sinkers as $sink)
                            <label for="{{ $sink->name }}">{{ $sink->name }}</label>
                            <input type="checkbox" class=" @error('name') is-invalid @enderror" value="{{ $sink->id }}"
                                id="add_ons_id" name="addons[]" /> ||
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @endforeach
                            @endif


                        </div>
                        <hr>
                        <h6>Quantity</h6>
                        <div class="d-flex">
                            <button type="button" id="decrement" class=" btn btn-outline-secondary">-</button>
                            <input class="form-control text-center" id="product_qty" type="num" value="1"
                                style="max-width: 3rem" />
                            <button type="button" id="increment" class=" btn btn-outline-secondary me-2">+</button>
                            <button id="btn-cart" class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection