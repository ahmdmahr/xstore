@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-header">
           <h4>Registered users</h4>
           <hr>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->fname . ' ' . $user->lname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>
                        
                        <a href="{{route('users.view',$user->id)}}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>
@endsection