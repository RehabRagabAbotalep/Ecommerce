@extends('frontend.master')
@section('content')
	<div class="row justify-content-center">
            <div class="col-md-8">
                <h3>My Orders</h3>
                   
                    
                <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th style="width:30%">Created-at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0;?>
                @foreach( $user_orders as $order)
                    <?php $total += $order->total_price; ?>

                     @foreach( $order->product as $product)
                    
                     <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->code}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$product->created_at}}</td>
                    </tr>
                    
                    @endforeach
                @endforeach

                </tbody>
                <tfoot>
                    <td class="hidden-xs text-center"><strong>Total ${{$total }}</strong></td>
                </tfoot>
            </table>
        
        
            </div>

    </div>
    <hr>
    <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>My Whishlist</h3>
                    @foreach($whishlists->chunk(3) as $chunkProduct)
                    <div class="row">
                      @foreach($chunkProduct as $whishlist)
                        <div class="col-xs-18 col-sm-6 col-md-3">
                            @foreach($whishlist->product as $product)
                                 <div class="thumbnail">
                                    <img src="images/{{$product->image}}" width="100px" height="100px">
                                    <p>{{$product->description}}</p>
                                    <p><strong>Price:</strong>{{$product->price}}$</p>
                                    <p class="btn-holder"><a href="{{route('addToCart',['id'=>$product->id])}}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                              </div>
                            @endforeach
                             
                        </div>
                      @endforeach  
                    </div>
                    
                @endforeach
            </div>
        </div>
                        
@endsection