<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        $products = Product::with('category')->get();
        //dd($products);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  $categories = Category::all();
       return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string',
            'price' =>'required',
            'image' =>'image|mimes:jpg,png,gif,jpeg|max:2048',
            'category_id'=>'required',
            'code' =>'required',
        ]);

        $product = new Product;
         if($request->hasFile('image')){
            $image = $request->image;
            $img_name = time() . "." .$request->image->getClientOriginalExtension();
            $request->image->move('images',$img_name);
            $product->image = $img_name;
         }
        $product->name = $request->name;
        $product->description = $request->des;
        $product->price = $request->price;
        $product->code = $request->code;
        $product->discount = $request->discount;
        $product->totalPrice =round((1-($product->discount/100))*$product->price,2);
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/products')->with('status', 'Your Product has been created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {  $categories = Category::all();
       $product = Product::find($id);
       return view('admin.product.edit',compact('product'),compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    $product = Product::find($id);
         $request->validate([
            'name' =>'required|string',
            'price' =>'required',
            'category_id'=>'required',
            'code' =>'required'
        ]);
         if($request->hasFile('image')){
            $image = $request->image;
            $img_name = time() . "." .$request->image->getClientOriginalExtension();
            $request->image->move('images',$img_name);
            $product->image = $img_name;
         }
        $product->name = $request->name;
        $product->description = $request->des;
        $product->price = $request->price;
        $product->code = $request->code;
        $product->category_id = $request->category_id;

        $product->save();
        
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
        
    }
}
