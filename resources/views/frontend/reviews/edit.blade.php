@extends('layouts.front')

@section('title', 'Edit your review')

@section('content')
   <div class="container py-5">
       <div class="row">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-body">
                          <h5>You are editing a review for {{ $review->product->name }}</h5>
                          <form action="{{route('edit-review.update')}}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="review_id" value="{{ $review->id }}">
                              <textarea class="form-control" rows="5" name="user_review"  placeholder="Write a review">{{$review->review}}</textarea>
                              <button type="submit" class="btn btn-primary mt-3">Update Review</button>
                          </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection