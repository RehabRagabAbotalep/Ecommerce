<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
   
    public function index()
    {   $categories = Category::all();
        return view('admin.category.show',compact('categories'));
    }

   
    public function create()
    {
       return view('admin.category.index');
    }

    
    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required|string'
       ]);
       Category::create($request->all());
        return redirect('/category')->with('status', 'Your Category has been created!');

    }


    public function delete(Category $category){
        $category->delete();
        return back();
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = Category::find($id);

        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        // Request Validation
        $request ->validate([
            'name' =>'required|string'
    ]);
        $category->name = $request->name;
        $category->save();
        return redirect('show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
