@extends('frontend.master')
@section('content')
     <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(session()->has('message')) 
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="col-sm-3 hidden-xs"><img src="public/images/{{$product->image}}" width="100" height="100" class="img-responsive"/></div>
                        <p>{{$product->description}}</p>
                        <p><strong>Price:</strong>${{$product->price}}</p>
                       @if($product->discount)
                        <p><strong>Discount:</strong>{{$product->discount}}%</p>
                        <p><strong>Price after Discount:</strong>${{$product->totalPrice}}</p>
                       @endif
                       <hr>
                       @if(Auth::check())

                        @if($product->review()->where('user_id',Auth::user()->id)->count()>5)
                            <p>Thank You For Your Review!</p>
                            @else
                                <h6>Please leave your Review</h6>
                                <form method="POST" action="{{route('review.store')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea name="review"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Rate</label>
                                        <select name="rate">
                                            @for($i=1;$i<=5;$i++)
                                                <option>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Save" class="btn btn-primary">
                                       <a href="{{route('reviews',['id'=>$product->id])}}" class="btn btn-primary" role="button">Show All Reviews</a>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </form>
                        @endif
                       @endif
                   </div>
                </div>
            </div>
        </div>
@endsection        