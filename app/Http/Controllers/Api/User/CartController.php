<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Product;
use App\User;
use Auth;
use Session;

class CartController extends Controller
{
     public function addToCart(Request $request ,$id){
     	$product = Product::find($id);
        $cart = session()->get('cart');
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
           $request->session('cart')->put('cart',$cart);
            return response()->json([
            	"message" =>'Product added Successfully'
            ],Response::HTTP_CREATED);
        }//end if
        // if Product already exists in Cart increase quantity by 1
       if(isset($cart[$id])){
        $cart[$id]['quantity']++;
        session()->put('cart',$cart);
        //dd(session('cart'));
        return response()->json([
            	"message" =>'Product added Successfully'
            ],Response::HTTP_CREATED);
        
       }//end if(isset($cart[$id])) 
       
       //if Product is not exist in the Cart Add it To Cart
       $cart[$id] =[
        'id' => $product->id,
        'name' =>$product->name,
        'price' =>$product->price,
        'image' =>$product->image,
        'quantity' =>1
       ];
        session()->put('cart',$cart);
       // dd(session('cart'));
        return response()->json([
            	"message" =>'Product added Successfully'
            ],Response::HTTP_CREATED); 
    }//end function addToCart

    public function getCart(Product $id){

    	 $total = 0 ;

        if(Session::has('cart')){
            foreach(session('cart') as $id => $product){

                 $total += $product['price'] * $product['quantity'] ;

                	

                   return Response([
                   	"name"     => $product['name'],
                   	"Price"    => $product['price'],
                   	"Quantity" => $product['quantity'],
                   	"Subtotal" => $product['price'] * $product['quantity'],
                   ]); 
             
            }
      }

      else{
        return "No Probuct in Your Cart";
      }




    }
}
