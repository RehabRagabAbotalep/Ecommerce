@extends('admin.layout.layout')
@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-body">
                        <h3>All Products</h3>
                        <h5>Total:{{count($products)}}</h5>
                        @if ($products->isEmpty())
                        <p> There is no Products.</p>
                        @else
                        <table class="table table-bordered">
                            <thead>
                            <th>No:</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Price</th>
                            <th>Product Code</th>
                            <th>Discount</th>
                            <th>TotalPrice</th>
                            <th>Product Caregory</th>
                            <th>Product Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>

                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->discount}}</td>
                                        <td>{{$product->totalPrice}}</td>
                                        <td>{{$product->category->name}}</td>

                                        <td><img src="images/{{$product->image}}" style="width: 100px; height: 100px;"></td>
                                        <td><a href="{{route('product.edit',
                                            ['id'=>$product->id])}}">Edit</a></td>
                                        <td><a href="{{route('product.delete',[
                                          'id'=>$product->id])}}" class="btn btn-primary">Delete</a></td>
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