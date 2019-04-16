@extends('admin.layout.layout')
@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h3>All Orders</h3>
                        <h5>Total:{{count($orders)}}</h5>
                        @if ($orders->isEmpty())
                        <p> There is no Orders.</p>
                        @else
                        <table class="table table-bordered">
                            <thead>
                            <th>No:</th>
                            <th>Product Code</th>
                            <th>Product Price</th>
                            <th>Status</th>
                            <th>Orderdby:</th>
                            <th>Cancel</th>
                            <th>Approved</th>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->code}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->email}}</td>
                                        <td><a href="{{route('order.cancel',['id'=>$order->id])}}">Cancel</a></td>
                                        <td><a href="{{route('order.approve',['id'=>$order->id])}}">Approve</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                        
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection