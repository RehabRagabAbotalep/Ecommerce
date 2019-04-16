<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Category;
use App\Product;

class ProductController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return ProductResource::collection($category->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Category $category)
    {

        $img_name = time() . "." .$request->image->getClientOriginalExtension();
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->code = $request->code;
        $product->image = $img_name;
        $category->product()->save($product);
        $request->image->move('images',$img_name);
        
        return Response([
            'data' => new ProductResource($product)
        ],Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,Product $product)
    {   
        $product->update($request->all());
        
            return response([
            'data' => new ProductResource($product)
        ],Response::HTTP_OK);
       
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,Product $product)
    {
        $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
