@extends('layouts.front')

@section('title')
My Wishlist
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Home</a> /
            <a href="{{ route('wishlist') }}">Wishlist</a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if ($wishlist->count() > 0)
                @foreach ($wishlist as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}" height="70px" width="70px" alt="Image here">
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{ $item->products->name }}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{ $item->products->selling_price }}$</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                            @if ($item->products->qty >= $item->prod_qty)
                                <h6>In stock</h6>
                            @else
                                <h6>Out of stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-success addWishToCart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-danger remove-wishlist-item">
                                <i class="fa fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @else
                <h4>There's no products in your wishlist</h4>
            @endif
        </div>
    </div>
</div>

@endsection
