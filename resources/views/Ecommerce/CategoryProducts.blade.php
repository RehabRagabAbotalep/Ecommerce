@extends('frontend.master')
@section('title')
	Laravel Ecommerce
@endsection
@section('content')
    
 <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
            	@if($products->isEmpty())
            		<p>No Products in This Category yet !</p>
            	@endif

            	@foreach($products->chunk(3) as $chunkProduct)
                    <div class="row">
                    @foreach($chunkProduct as $product)
                        <div class="col-xs-18 col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <a href="{{route('product.show',['id'=>$product->id])}}"><img src="images/{{ $product->image }}" width="150" height="100"></a>
                                <div class="caption">
                                    <h4>{{ $product->name }}</h4>
                                    <p>{{$product->description}}</p>
                                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                                    
                                        @if($product->review->count() >0)
                                            <p><strong>Rate:</strong> 
                                            {{round($product->review->avg('star'),2)}}
                                        
                                        <strong>Votes:</strong> {{$product->review->count()}}
                                        </p>
                                        @else
                                            <p><strong>Rate:</strong>"No Rating",</p>
                                        @endif
                                    <p class="btn-holder"><a href="{{route('addToCart',['id'=>$product->id])}}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                                </div>
                            </div>
                        </div>
            
                   @endforeach
            </div>
                
            @endforeach

            </div>
        </div>
    </div>
</div>
    
@endsection