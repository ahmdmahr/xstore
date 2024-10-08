@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4>
                        Orders History
                        <a href="{{route('orders.index')}}" class="btn btn-warning float-right">Current Orders</a>
                    </h4>
                    
                </div>
                <div class="card-body">
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Order Date</th>
                             <th>Tracking No.</th>
                             <th>Total Price</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($orders as $order)
                             <tr>
                                <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                                 <td>{{$order->tracking_no}}</td>
                                 <td>{{$order->total_price}}</td>
                                 <td>{{$order->status == 0?'pending':'completed'}}</td>
                                 <td>
                                     <a href="{{route('orders.view',$order->id)}}" class="btn btn-primary">View</a>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection