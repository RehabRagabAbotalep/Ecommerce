

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

@extends('admin.layout.layout')
@section('content')
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Users</h3>
                        <table class="table table-bordered">
                        	<thead>
                        		<tr>
                        			<th>ID</th>
                                    <th>Name</th>
                        			<th>Email</th>
                        			<th>Edit</th>
                                    <th>Delete</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		@foreach($users as $user)
                        			<tr>
                                        <td><i class="fas fa-user"></i></td>
                                       
                                       
                        				<td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                        			     <td>
                                            @if($user->is_admin ==1)
                                            <a href="{{route('user.deleteAdmin',['id'=>$user->id])}}">deleteAdmin</a>
                                            @else
                                            <a href="{{route('user.admin',['id'=>$user->id])}}">MakeAdmin</a>
                                          </td>
                                            @endif


                                        <td><a href="{{route('user.delete',['id'=>$user->id])}}">Delete</a></td>
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
