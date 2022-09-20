@extends('layouts.frontend')

@section('title')
Cart
@endsection

@section('content')
<div class="container my-4">
    <br>
    <br>
    <div class="card shadow mb-2">
        <div class="card-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Sugar</td>
                            <td>Add-ons</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    @php
                    $sum_of_price_add_ons = 0;
                    $total = 0;
                    @endphp
                    @foreach ($cart_items as $item)
                    <tbody class="product_data">
                        <input type="hidden" value="{{ $item->product->id }}" class="product_id">
                        <tr>
                            <td>
                                @if ($item->product->image == 'NULL')
                                <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="60px" width="60px">
                                @else
                                <img src="{{ asset('assets/products/'. $item->product->image) }}"
                                    alt="{{ $item->product->name }}" height="60px" width="60px" />
                                @endif

                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->sugar_level}}%</td>
                            <td>{{ $item->addOns->name }}</td>
                            <td>{{ $item->product_qty }}</td>
                            <td>&#8369;{{ $item->bottle_size }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger cart_delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    @php
                    $sum_of_price_and_add_ons = $item->bottle_size + $item->addOns->price;
                    $total += $sum_of_price_and_add_ons * $item->product_qty;
                    @endphp
                    @endforeach
                </table>

            </div>
        </div>
        <div class="card-footer ">
            Grand Total: <span>&#8369; {{ $total ?? "" }} </span> <a href="{{ url('/checkout') }}"
                class="btn btn-warning btn-md float-end">Checkout</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );
</script>
@endsection