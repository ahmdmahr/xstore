@extends('layouts.front')

@section('title', 'Write a review')

@section('content')
   <div class="container py-5">
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-body">
                       @if($verified_purchase->count() > 0)
                          <h5>You are writing a review for {{ $product->name }}</h5>
                          <form action="{{route('add-review.create')}}" method="POST">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <textarea class="form-control" rows="5" name="user_review" placeholder="Write a review"></textarea>
                              <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                          </form>
                       @else
                           <div class="alert alert-danger">
                               <h5>You are not eligible to review this product</h5>
                               <p>
                                   For the trustworthiness of the reviews, only customers who purchase the product can write review about the product.
                               </p>
                               <a href="{{url('/')}}" class="btn btn-primary">Go to home page</a>
                           </div>
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection