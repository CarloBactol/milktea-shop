@extends('layouts.frontend')

@section('title')
Cart
@endsection

@section('content')
<div class="container">
    <br>
    <br>
    <br>
    <br>

    <div class="col-md-12">
        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Sugar</td>
                    <td>Add-ons</td>
                    <td>Add-ons total</td>
                    <td>Size</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
            $sum_of_price_add_ons = 0;
            $total = 0;
            $cart_id = 0;
            @endphp
            <tbody class="product_data">
                @foreach ($cart_items as $cart_item)
                @php
                $cart_id = $cart_item->product->id;
                @endphp
                <input type="hidden" value="{{ $cart_item->product->id }}" class="product_id">
                <tr>
                    <td>
                        @if ($cart_item->product->image == 'NULL')
                        <img src="{{ asset('assets/products/1.jpg') }}" class="rounded-circle" alt="" height="60px"
                            width="60px">
                        @else
                        <img src="{{ asset('assets/products/'. $cart_item->product->image) }}"
                            alt="{{ $cart_item->product->name }}" class="rounded-circle" height="60px" width="60px" />
                        @endif

                    </td>
                    <td>{{ $cart_item->product->name }}</td>
                    <td>{{ $cart_item->sugar_level}}%</td>
                    <td>
                        @php
                        // get the the addons array
                        $add_ons = json_decode($cart_item->add_ons_id);
                        // total count of addons
                        $total_add_ons = count($add_ons) * 10 ;
                        $counter = 0;
                        $prem_price = 0;
                        @endphp
                        {{-- Loops the data from json_decode() --}}
                        @foreach ($add_ons as $addon)
                        @if ($addon > 0)
                        @foreach ($addons as $add)
                        <input type="hidden" value="{{  $add_ons_price =  $add->price}}">
                        @if ($addon == $add->id)
                        <span>{{ $add->name }},</span>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </td>
                    <td>₱{{$total_add_ons }}</td>
                    <td>
                        @if($cart_item->bottle->size == 0)
                        Small
                        @elseif ($cart_item->bottle->size == 1)
                        Meduim
                        @elseif ($cart_item->bottle->size == 2)
                        Large
                        @else
                        "No size"
                        @endif
                    </td>
                    <td>{{ $cart_item->product_qty }} pcs</td>
                    <td>
                        @if ($cart_item->category_id == 2)
                        @foreach ($premiumAddons as $prem)
                        @if ( $cart_item->bottle_size_id == $prem->id)
                        <input type="hidden" value="{{$prem_price += $prem->price}}">
                        {{$prem->price }}
                        @endif
                        @endforeach
                        @else
                        {{ $cart_item->bottle_size_id == $cart_item->bottle->id ? $cart_item->bottle->price : ""}}
                        @endif

                    </td>
                    <td>
                        <input type="hidden" value="{{ $cart_id }}" id="cart_id">
                        <button class="btn btn-sm btn-outline-danger cart_delete">
                            <i class="fas fa-trash"></i>
                        </button>
                        {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-id={{ $cart_item->id }}
                            data-original-title="Delete" class="delete btn btn-danger btn-sm deleteCart"><i
                                class="fas fa-trash"></i></a> --}}
                    </td>
                </tr>
                {{-- Compute total --}}
                @php
                if ($cart_item->category_id == 2){
                $sum_of_price_and_add_ons = $prem_price + $total_add_ons;
                $total += $sum_of_price_and_add_ons * $cart_item->product_qty;
                }else{
                $sum_of_price_and_add_ons = $cart_item->bottle->price + $total_add_ons;
                $total += $sum_of_price_and_add_ons * $cart_item->product_qty;
                }
                @endphp
                @endforeach
            </tbody>
        </table>
        <hr>
        @if ($total != NULL)
        <div class="d-flex justify-content-center mt-3 gap-4">
            <h4 class="text-success text-bold text-lg ">Total: &#8369;{{ $total}}</h4>
            <a href="{{ url('/checkout') }}" class="btn btn-md btn-warning ">Checkout</a>
        </div>
        @endif
    </div>
</div>
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