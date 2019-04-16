@extends('frontend.master')
@section('content')
	 <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1>Sign In</h1>
                        <form action="{{route('user.signin')}}" method="Post">
                             @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                             @endforeach
                             @if (session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div>
                            @endif
                         {{ csrf_field() }}
                            <div class="form-group">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                          </div>
                        </form>
                </div>
                </div>
            </div>
        </div>
@endsection