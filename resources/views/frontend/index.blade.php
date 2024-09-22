@extends('layouts.front')

@section('title')
  Welcome to XStore
@endsection

@section('content')

   @include('layouts.frontend.slider')


  <div class="py-5">
    <div class="container">
      <div class="row">
        <h2>Featured Products</h2>
        <div class="owl-carousel featured-carousel owl-theme">
          @foreach ($featured_products as $prod)
        <div class="item">
          <div class="card">
            <a href="{{route('view-product',$prod->id)}}">
           <img src="{{asset('assets/uploads/product/'.$prod->image)}}" alt="Product Image">
           <div class="card-body">
             <h5> {{$prod->name}} </h5>
             <span class="float-start">{{$prod->selling_price}}$</span>
             {{-- The <s> tag specifies text that is no longer correct, accurate or relevant. The text will be displayed with a line through it. --}}
             <span class="float-end"><s>{{$prod->original_price}}</s>$</span>
           </div>
          </a>
          </div>
        </div>
        @endforeach
      </div>
        

      </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <h2>Trending Categories</h2>
        <div class="owl-carousel featured-carousel owl-theme">
          @foreach ($popular_categories as $cat)
        <div class="item">
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
   
@endsection

@section('scripts')
<script>
  $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        // the number to show in laptop screen
        1000:{
            items:4
        }
    }
})
</script>
@endsection