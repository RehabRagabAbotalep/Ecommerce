@extends('frontend.master')
@section('title')
	Laravel Ecommerce
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<h3>All Reviews</h3>
		@foreach($reviews as $review)
			<p>{{ $review->review }}
				<strong>by</strong>
				{{ $review->user->name }}
			</p><hr>
			<h4>All Comments</h4>
			@foreach($review->comment as $comment)
				<p>{{ $comment->comment }}
				<strong>by</strong>
				{{ $comment->user->name }}
			</p>

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
			@foreach($comment->replies as $reply)
				<p>{{ $reply->comment }}
				<strong>by</strong>
				{{ $reply->user->name }}
			</p>
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
				<?php 
					$repliescomment1 = App\Comment::where('parent_id',$reply->id)->get();
				?>
				@foreach($repliescomment1 as $reply1)
					{{$reply1->comment}}
					<form class="form-inline" method="Post" action="{{route('reply.store')}}">
				{{ csrf_field() }}
				<div class="form-group mb-2">
					<label>Reply:</label>&nbsp;
					<input type="text" name="reply" class="form-control" placeholder="Reply">
				</div>
			 	&nbsp;<button type="submit" class="btn btn-primary mb-2">Reply</button>
				<input type="hidden" name="review_id" value="{{$review->id}}">
				<input type="hidden" name="comment_id" value="{{$reply1->id}}">
			</form>
			<?php
				$repliescomment2 = App\Comment::where('parent_id',$reply1->id)->get();
			?>
			@foreach($repliescomment2 as $reply2)
				{{$reply2->comment}}
				<form class="form-inline" method="Post" action="{{route('reply.store')}}">
				{{ csrf_field() }}
				<div class="form-group mb-2">
					<label>Reply:</label>&nbsp;
					<input type="text" name="reply" class="form-control" placeholder="Reply">
				</div>
			 	&nbsp;<button type="submit" class="btn btn-primary mb-2">Reply</button>
				<input type="hidden" name="review_id" value="{{$review->id}}">
				<input type="hidden" name="comment_id" value="{{$reply2->id}}">
			</form>
			<?php
				$repliescomment3 = App\Comment::where('parent_id',$reply2->id)->get();
			?>
			@foreach($repliescomment3 as $reply3)
				{{$reply3->comment}}
				<form class="form-inline" method="Post" action="{{route('reply.store')}}">
				{{ csrf_field() }}
				<div class="form-group mb-2">
					<label>Reply:</label>&nbsp;
					<input type="text" name="reply" class="form-control" placeholder="Reply">
				</div>
			 	&nbsp;<button type="submit" class="btn btn-primary mb-2">Reply</button>
				<input type="hidden" name="review_id" value="{{$review->id}}">
				<input type="hidden" name="comment_id" value="{{$reply3->id}}">
			</form>
			<?php
				$repliescomment4 = App\Comment::where('parent_id',$reply3->id)->get();
			?>
			@foreach($repliescomment4 as $reply4)
				{{$reply4->comment}}
			@endforeach
			@endforeach
			@endforeach
				@endforeach
			@endforeach
			<hr>
			@endforeach
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
