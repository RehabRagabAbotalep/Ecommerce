

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Ecommerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('UserHome')}}"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline" action="{{route('category.product')}}">
      <?php use App\Category;?>
    <select class="form-control" name="category_id">
      <option value="0">select Category</option>
      @foreach($category=Category::all() as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
      @endforeach
    </select>    
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  </div>
    <div>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('Cart')}}"><i class="fas fa-shopping-cart"></i> Shopping Cart
            @if(Auth::check())
                <span class="badge badge-pill badge-danger">
                    {{count(session('cart_'.Auth::user()->id))}}
                </span>
            @endif
        </a>
      </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
          User Mangement
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::check())
              <a class="dropdown-item" href="{{route('user.profile')}}">User Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('user.logout')}}">LogOut</a>
        
          @else
            <a class="dropdown-item" href="{{route('user.signup')}}">Sign Up</a>
          <a class="dropdown-item" href="{{route('user.signin')}}">Sign In</a>
          @endif
        </div>
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>
