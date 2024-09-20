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
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                <tr>
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->name}}</td>
                    <td>{{$cat->description}}</td>
                    <td>
                        <img src="{{ asset('assets/uploads/category/'.$cat->image)}}" class="cat-image" alt="Image">
                    </td>
                    <td>
                        <button class="btn btn-primary">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>
@endsection