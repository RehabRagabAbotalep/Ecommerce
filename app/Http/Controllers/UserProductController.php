<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Order;
use App\Review;
use App\Whishlist;
use App\Ad;
use Auth;
use Session;
class UserProductController extends Controller
{
     public function getproduct(){
        $products = Product::with('category')->get();
        $ads = Ad::get();
        //dd($products);
        return view('Ecommerce.index',compact('products'),compact('ads'));

    }
    
    //get Product by Category
    
    public function products(Request $request){
      $products = new Product;
      $category_id  = $request->category_id;
      $products->category_id = $category_id;
      $products = Product::where('category_id',$category_id)->get();
     // dd($products);
      return view('Ecommerce.CategoryProducts',compact('products'));

    }

    //display one product
    public function show($id){
      $product = Product::find($id);
      //dd($product);
      return view('Ecommerce.show',compact('product'));
    }

    //store Review
    public function storereview(Request $request){
      $review = new Review;
      $user_id = Auth::user()->id;
      $product_id = $request->product_id;
      $request->validate(['rate'=>'required']);
      $review->review = $request->review;
      $review->star = $request->rate;
      $review->product_id = $product_id;
      $review->user_id = $user_id;

      //check if user bought this product or not
      if($order = Order::where('user_id',$user_id)
      ->whereHas('product', function ($query) use ($product_id) {
         $query->where('product_id', $product_id);
      })
      ->count()>0){
        $review->save();
      
        return back()->with('message','Thank You For Reviewing!:)');
      }
        else{
       
            return redirect('UserHome')->with('message','You Cant Review This Product!');
           
      }
      
    }



    //Create Cart View
    public function cart(){
        
        //$user = session()->get('cart_'.Auth::user()->id);
    	return view('Users.cart');
    }
    //Add To Cart function
    public function addToCart(Request $request ,$id){
        $product = Product::find($id);
        $cart = session()->get('cart_'.Auth::user()->id);
        // No Items In the Cart
        if(!$cart){
            $cart =[
                $id =>[
                    'id' => $product->id,
                    'name' =>$product->name,
                    'price' =>$product->price,
                    'image' =>$product->image,
                    'quantity' => 1
                ]
            ];
           $request->session('cart_'.Auth::user()->id)->put('cart_'.Auth::user()->id,$cart);
            return back()->with('success','Product Added Successfully');  
        }//end if
        // if Product already exists in Cart increase quantity by 1
       if(isset($cart[$id])){
        $cart[$id]['quantity']++;
        session()->put('cart_'.Auth::user()->id,$cart);
        //dd(session('cart'));
        return back()->with('success','Product Added Successfully');
        
       }//end if(isset($cart[$id])) 
       
       //if Product is not exist in the Cart Add it To Cart
       $cart[$id] =[
        'id' => $product->id,
        'name' =>$product->name,
        'price' =>$product->price,
        'image' =>$product->image,
        'quantity' =>1
       ];
        session()->put('cart_'.Auth::user()->id,$cart);
       // dd(session('cart'));
        return back()->with('success','Product Added Successfully'); 
    }//end function addToCart

    //checkOut Function
    public function checkout(){
        
        $user_id = Auth::user()->id;
        $order = new Order;
        $total = 0;
        if(Session::has('cart_'.Auth::user()->id)){
         foreach(session('cart_'.Auth::user()->id) as $id => $product){
          $total += $product['price'] * $product['quantity'] ;
          $order->total_price = $total;
          $order->quantity = $product['quantity'];
          $order->user_id = $user_id;
          $order->save();
          $order->product()->sync($product['id'],false);
          }//end foreach
          
         
         Session::forget('cart_'.Auth::user()->id);
         return redirect()->back();
       }
       else{
         return redirect('UserHome');
       }
         
         
    }//end Checkout Function

}//end of Class
