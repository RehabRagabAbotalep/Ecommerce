@extends('frontend.master')
@section('title')
	Laravel Ecommerce
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<h3>All Reviews</h3>
		
				@foreach($reviews as $review)
			
					
						<span> {{ $review->review }} :</span>
						<strong>by&nbsp;</strong>{{ $review->user->name }}
						<br>
						@foreach($review->comment as $comment)
							<span> {{ $comment->comment }} :</span>
							<strong>by&nbsp;</strong>{{ $comment->user->name }}
							<h4>Replies</h4>
							@foreach($comment->replies as $reply)
								<p> {{ $reply->comment }} :
							 	<strong>by&nbsp;</strong>{{ $reply->user->name }}</p>
								 	<form class="form-inline" method="Post" action="{{route('reply.store')}}">
									{{ csrf_field() }}
								  <div class="form-group mb-2">
								    <label>Reply:</label>&nbsp;
								    <input type="text" name="reply" class="form-control" placeholder="Reply">
								  </div>
								   &nbsp;<button type="submit" class="btn btn-primary mb-2">Reply</button>
								   <input type="hidden" name="review_id" value="{{$review->id}}">
								   <input type="hidden" name="comment_id" value="{{$reply->id}}">
								    </form>
							@endforeach
							<form class="form-inline" method="Post" action="{{route('reply.store')}}">
								{{ csrf_field() }}
							  <div class="form-group mb-2">
							    <label>Reply:</label>&nbsp;
							    <input type="text" name="reply" class="form-control" placeholder="Reply">
							  </div>
							   &nbsp;<button type="submit" class="btn btn-primary mb-2">Reply</button>
							   <input type="hidden" name="review_id" value="{{$review->id}}">
							   <input type="hidden" name="comment_id" value="{{$comment->id}}">
							    </form>
							    <hr>
						@endforeach
						<hr>
						
							@if($review->comment->count()<5)
								<form class="form-inline" method="Post" action="{{route('comment.store')}}">
								{{ csrf_field() }}
							  <div class="form-group mb-2">
							    <label>YourComment :</label>&nbsp;
							    <input type="text" name="comment" class="form-control" placeholder="Comment">
							  </div>
							   &nbsp;<button type="submit" class="btn btn-primary mb-2">Comment</button>
							   <input type="hidden" name="review_id" value="{{$review->id}}">

							    </form>
							    <hr>
							@endif

							
					
					
					
				@endforeach
			
		
	</div>
</div>
@endsection
