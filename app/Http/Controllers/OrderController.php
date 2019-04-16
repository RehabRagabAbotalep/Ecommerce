<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;
use DB;

class OrderController extends Controller
{   //show all orders
    public function getAllOrders(){
      
        $orders = DB::table('order_product')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('products.id','products.code' ,'products.price','orders.total_price','orders.status','orders.id','users.email')
            ->get();
            //dd($orders);
            return view('admin.orders.index',compact('orders'));
    
    }//end Function
    
    //Cancel Order Function
    public function cancelOrder($id){
        $order = Order::find($id);
        $order->status="Cancelled";
        $order->save();
        return redirect()->back();
       
    }
    
     public function ApproveOrder($id){
        $order = Order::find($id);
        $order->status="Approved";
        $order->save();
        return redirect()->back();
       
    }
}
