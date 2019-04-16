<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Whishlist;
use Auth;

class WhishlistController extends Controller
{
    
  public function store($product){
  	$user_id = Auth::user()->id;
  	//check if user add this Product to his Whishlist or not
  	if($whishlist = Whishlist::where('user_id',$user_id)
      ->whereHas('product', function ($query) use ($product) {
         $query->where('product_id', $product);
      })
      ->count()==0){
        $user_id = Auth::user()->id;
  	    $whishlist = new Whishlist;
  	    $whishlist->user_id = $user_id;
  		$whishlist->save();
		$whishlist->product()->sync($product,false);
		return redirect('UserHome');
  	}
  	else{
  		return back();

  }
  	}
}
