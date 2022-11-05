@extends('layouts.frontend')

@section('title')
Shop
@endsection
@section('content')

<div class="container my-4">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h2>Filter Products</h2>
                </div>
                <div class="card-body">

                    <select name="categories" id="cat_id" class="form-control">
                        <option selected value="0">All Products</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row" id="tbody">
                @foreach ($products as $item)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <img src="{{ asset('assets/products/'.$item->image) }}" alt="{{ $item->name }}" height="150px">
                        <div class="card-body">
                            <h6>{{ $item->name }}</h6>
                        </div>
                        <div class="card-footer">
                            @if ($item->category_id == 2)
                            <span class="badge bg-danger"> <i class="fa fa-fire"></i> Premuim</span>
                            @elseif ($item->category_id == 3)
                            <span class="badge bg-success">Best Seller</span>
                            @elseif ($item->category_id == 1)
                            <span class="badge bg-primary">Regular</span>
                            @else
                            <span class="badge bg-primary">Regular</span>
                            @endif
                            <a href="{{ url('/view-product/'.$item->id) }}" class="btn btn-sm btn-success float-end">Add
                                <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#cat_id").on('change',function(){
            var category = $(this).val();
            // pass http request
            $.ajax({
                url: "{{ url('/shop') }}",
                type: 'GET',
                data: {'category': category},
                success: function (data) {
                    var products = data.products;
                    var html = "";

                    if(products.length > 0){
                        //loop 
                        for (let i = 0; i < products.length; i++) {
                                let img = '<img class="card-img-top" src="assets/products/'+products[i]['image'] +'" height="150px" max-width="100%" alt=" '+products[i]['name']+' "/>';
                                let static_img  = '<img class="card-img-top" src="assets/products/1.jpg" height="150px" max-width="100%" alt="milktea"/>';
                                const str = products[i]['description'];
                                const num = 50;
                                const limitString = (str = '', num = 1) => {
                                const { length: len } = str;
                                    if(num < len){
                                        return str.slice(0, num) + '...';
                                    }else{
                                        return str;
                                    };
                                };

                                if(products[i]['category_id'] == 2){
                                    var badge = '<span class="badge bg-danger"><i class="fa fa-fire"></i> Premuim</span>';
                                }else if(products[i]['category_id'] == 3){
                                    var badge = '<span class="badge bg-success">Best Seller</span>';
                                }else if(products[i]['category_id'] == 1){
                                    var badge = '<span class="badge bg-primary">Regular</span>';
                                }else{
                                    var badge = '<span class="badge bg-primary">Regular</span>'; 
                                }

                                html += '<div class="col-md-3"><div class="card mb-2">'+ img+ '<div class="card-body"><h6 class="card-title">'+products[i]['name'] +'</h6></div><div class="card-footer">'+badge+'<a href="/view-product/ '+products[i]['id']+' " class="btn btn-sm btn-success float-end">Add <i class="fa fa-shopping-cart"></i></a></div></div></div>';
                        }
                    }else{
                        html += '<span class="text-danger">No data found!</span>';
                    }

                    $('#tbody').html(html);
                }
            })
        })
    })
</script>
@endsection