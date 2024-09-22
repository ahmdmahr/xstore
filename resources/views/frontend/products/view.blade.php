@extends('layouts.front')

@section('title', $product->name)

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{route('f-categories')}}">
                Collections
            </a> /
            <a href="{{route('view-category',$product->category->id)}}">
                {{ $product->category->name }}
            </a> /
            <a href="{{route('view-product',$product->id)}}">
                {{ $product->name }} 
            </a>
        </h6>
    </div>
</div>

<div class="container">
    <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ asset('assets/uploads/product/' . $product->image) }}" class="w-100" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{ $product->name }}
                        @if($product->trending == 1)
                            <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                        @endif
                    </h2>
                    <hr>
                    <label class="me-3">Original Price: <s>$ {{ $product->original_price }}</s></label>
                    <label class="fw-bold">Selling Price: $ {{ $product->selling_price }}</label>
                    <p class="mt-3">
                        {!! $product->small_description !!}
                    </p>
                    <hr>
                    <label class="badge {{ $product->qty > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->qty > 0 ? 'In stock' : 'Out of stock' }}
                    </label>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <input type="hidden" value="{{ $product->id }}" class="prod_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" value="1" class="form-control qty-input" />
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <br/>
                            <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                            <button type="button" class="btn btn-success me-3 float-start">Add to Wishlist <i class="fa fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

