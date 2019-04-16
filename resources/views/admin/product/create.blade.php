@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/product/store" method="Post" enctype="multipart/form-data">
                             @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                             @endforeach
                             @if (session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div>
                            @endif
                         {{ csrf_field() }}
                         <h3>Add New product</h3>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Product Name" required="required">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <textarea class="form-control" rows="5" name="des"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Product Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Product price" required="required">
                          </div>
                           <div class="form-group">
                            <label for="formGroupExampleInput">Product Code</label>
                            <input type="text" class="form-control" name="code" placeholder="Product Code" required="required">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Discount</label>
                            <input type="number" class="form-control" name="discount" placeholder="discount" >
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
                              <button type="submit" class="btn btn-primary">Add Product
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
