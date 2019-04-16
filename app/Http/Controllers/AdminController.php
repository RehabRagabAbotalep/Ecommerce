<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;

class AdminController extends Controller
{
     public function __construct()
    {
        $this->middleware('IsAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function admin()

    {                      

        return view('admin.adminhome');

    }
    public function create(){
        return view('admin.ads');
    }

    public function store(Request $request){
        $ad = new Ad;
        $request->validate([
            'image' =>'image|mimes:jpg,png,gif,jpeg|max:2048',
        ]);
        $ad->link = $request->link;
        $img_name = time() . "." .$request->image->getClientOriginalExtension();
            $request->image->move('banner',$img_name);
            $ad->image = $img_name;
            $ad->save();
            return back();


    }
    
}
