@extends('frontend.master')


@section('content')

    @if(session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif

    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>

        @if(Session::has('cart_'.Auth::user()->id))
            @foreach(session('cart_'.Auth::user()->id) as $id => $product)

                <?php $total += $product['price'] * $product['quantity'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="images/{{$product['image']}}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $product['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $product['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="text" value="{{ $product['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $product['price'] * $product['quantity'] }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr>
            <td><a href="{{route('UserHome')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td> 
        </tr>
        <tr><td><a href="{{route('checkout')}}" class="btn btn-warning"><i class="fas fa-wallet"></i>CheckOut</a></td></tr>
        </tfoot>
    </table>

@endsection
