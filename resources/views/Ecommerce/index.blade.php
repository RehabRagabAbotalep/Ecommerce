@extends('frontend.master')
@section('title')
	Laravel Ecommerce
@endsection
@section('content')

    @if(session('success'))
        <div class="alert alert-success" >
            {{session('success')}}
        </div>
    @endif

        <!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

  <div class="carousel-inner" role="listbox">
   @foreach($ads as $ad)
    <div class="carousel-item active">
      <img class="d-block w-100" src="banner/{{$ad->image}}"
        width="511px" height="340px">
    </div>
   @endforeach
    </div>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
    
        @foreach($products->chunk(4) as $chunkProduct)

            <div class="row">
                @foreach($chunkProduct as $product)
                    <div class="col-xs-18 col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="{{route('product.show',['id'=>$product->id])}}"><img src="images/{{ $product->image }}" width="150" height="100"></a>
                            <div class="caption">
                                <h4>{{ $product->name }}</h4>
                                <p>{{$product->description}}</p>
                                <p><strong>Category:</strong> {{$product->category->name}}</p>
                                <p><strong>Price: </strong> {{ $product->price }}$</p>
                                <p><strong>Add To List</strong><a href="{{route('whishlist',['id'=>$product->id])}}"><i class="fas fa-heart"></i></a></p>
                                
                                    @if($product->review->count()>0)
                                        <p><strong>Rate:</strong> 
                                        {{round($product->review->sum('star')/$product->review->count(),2)}}
                                    
                                    <strong>Votes:</strong> {{$product->review->count()}}
                                    </p>
                                    @else
                                        <p><strong>Rate:</strong>"No Rating"</p>
                                    @endif
                                <p class="btn-holder"><a href="{{route('addToCart',['id'=>$product->id])}}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                            </div>
                        </div>
                    </div>
        
               @endforeach
        </div>
            
        @endforeach

    
@endsection
