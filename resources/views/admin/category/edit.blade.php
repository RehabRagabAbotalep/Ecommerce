@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.update',['id'=>$category->id])}}" method="Post">
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
                            <label for="formGroupExampleInput">Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{$category->name}}">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                          </div>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>

 

@endsection
