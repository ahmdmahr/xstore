@extends('layouts.front')

@section('title')
  Categories
@endsection

@section('content')
  <div class="py-5">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2>All Categories</h2>
                  <div class="row">
                  @foreach ($category as $cat)
                  <div class="col-md-3 mb-3">
                    <a href="{{route('view-category',$cat->id)}}">
                    <div class="card">
                     <img src="{{asset('assets/uploads/category/'.$cat->image)}}" alt="Category Image">
                     <div class="card-body">
                       <h5> {{$cat->name}} </h5>
                       <p>
                           {{$cat->description}}
                       </p>
                     </div>
                    </div>
                    </a>
                  </div>
                  @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection