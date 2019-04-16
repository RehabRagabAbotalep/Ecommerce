@extends('admin.layout.layout')
@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>All Categories</h3>
                        @if($categories ->isEmpty())
                            <p>No Categories</p>
                            @else
                                <h4>Total:{{count($categories)}}</h4>
                        <table class="table table-bordered">
                        	<thead>
                        		<tr>
                        			<th>ID</th>
                        			<th>Name</th>
                                    <th>Edit</th>
                        			<th>Delete</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		@foreach($categories as $categorey)
                        			<tr>
                        				<td>{{$categorey->id}}</td>
                        				<td>{{$categorey->name}}</td>
                                        <td><a href="{{route('category.edit',
                                            ['id'=>$categorey->id])}}">Edit</a></td>
                        				<td><a href="/{{ $categorey->id }}/delete" class="btn btn-primary">Delete</a></td>
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