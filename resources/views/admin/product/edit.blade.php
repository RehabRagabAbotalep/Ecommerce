@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.update',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                             @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                             @endforeach
                             @if (session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div>
                            @endif
                         {{ csrf_field() }}
                         <h3>Edit Product:{{$product->name}}</h3>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <textarea class="form-control" rows="5" name="des">
                              {{$product->description}}
                            </textarea>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Price</label>
                            <input type="number" class="form-control" name="price" value="{{$product->price}}">
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Product Code</label>
                            <input type="text" class="form-control" name="code" value="{{$product->code}}">
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Category</label>
                            <select class="form-control" name="category_id">
                              <option value="0">Select category</option>
                              @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Product Image</label>
                            <input type="file" name="image">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Edit
                              </button>
                            </div>
                          </div>

                          </div>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>

 

@endsection
