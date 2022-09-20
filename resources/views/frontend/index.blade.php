@extends('layouts.frontend')

@section('title')
Home
@endsection
@section('content')
@include('layouts.inc.slider-frontend')
<div class="container my-5">
  <div class="row">
    <h2>Best Seller Products</h2>
    <div class="owl-carousel owl-theme">
      @foreach ($products as $item)
      <div class="item">
        <div class="card">
         <a href="{{ url('/view-product/'.$item->id) }}">
         @if ($item->image == 'NULL')
           <img src="{{ asset('assets/products/1.jpg') }}" alt="" height="200px">
         @else
         <img src="{{asset('assets/products/'. $item->image) }}" alt="" height="200px">
         @endif
         </a>
          <div class="card-body">
            <h5>{{ $item->name }}</h5>
            <hr>
            <span>Onhand: {{ $item->qty > 0 ? $item->qty : 'Out of Stock' }}</span><a href="{{ url('/view-product/'.$item->id) }}" class="btn btn-sm btn-success float-end">View</a>
            <p>{!! Str::limit($item->description, 50)!!}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div
    </div>
</div>

<!-- Footer-->
@include('layouts.inc.footer-frontend')

@endsection


@section('scripts')
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection