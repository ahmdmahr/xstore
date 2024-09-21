@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-header">
           <h4>Category Page</h4>
           <hr>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    {{-- <th>Description</th>
                    <th>Original Price</th> --}}
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->name}}</td>
                    {{-- <td>{{$product->description}}</td>
                    <td>{{$product->original_price}}</td> --}}
                    <td>{{$product->selling_price}}</td>
                    <td>
                        <img src="{{ asset('assets/uploads/product/'.$product->image)}}" class="cat-image" alt="Image">
                    </td>
                    <td>
                        <a href="{{route('edit-product',$product->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{route('delete-product',$product->id)}}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>
@endsection