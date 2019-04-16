@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/ads/store" method="Post" enctype="multipart/form-data">
                             @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                             @endforeach
                             @if (session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div>
                            @endif
                         {{ csrf_field() }}
                         <h3>Add New Ad</h3>
                          <div class="form-group">
                            <input type="text" class="form-control" name="link" placeholder="link" >
                          </div>
                         
                           <div class="form-group">
                            <label for="formGroupExampleInput">Ads Image</label>
                            <input type="file" name="image">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Add 
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
