<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\profile;
use App\Order;
use App\Product;
use App\Whishlist;
use Hash;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users|max:255|string',
            'password'=>'required|string|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =hash::make($request->password);
        $user->save();
        
        $profile = Profile::create([
            'user_id' =>$user->id,
        ]);
        return redirect('users');
    }


    //delete User 
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }

    //delete the Admin role from the User 
    public function deleteAdmin($id){
        $user = User::find($id);
        $user->is_admin =0;
        $user->save();
        return back();
    }

    //Give The User admin role
    public function admin($id){
        $user = User::find($id);
        $user->is_admin =1;
        $user->save();
        return back();
    }
    // create Sign Up View
    public function getSignup(){
        return view('Users.signup');
    }

    // Store Sign Up Request
    public function postSignup(Request $request){
        //1: Validate Request
        $request->validate([
            'name' =>'required|string',
            'email' =>'email|string|required|unique:users',
            'password' =>'required|min:4' 
        ]);
        //2: Store Request
        $user = new User([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>hash::make($request->password)
        ]);
        $user->save();
        Auth::login($user);
        //redirect To UserHome Page
        return redirect('UserHome');  
    }
    
    // create Signin view
    public function getSignin(){
        return view('Users.signin');
    }
    
    //User Sign In function
     public function postSignin(Request $request){
        //Validate Request
        $request->validate([
            'email' =>'required|email',
            'password' =>'required|min:4'
        ]);
        //check if email and password exisit in database
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password ])){
            return redirect()->route('user.profile');
        }
        return back();
    }

    //User Profile
    public function getProfile(){
        $user_id = Auth::user()->id;
       
       $user_orders = Order::where('user_id', $user_id)->with('product','user')->get();
        //dd($user_orders);
       $whishlists = Whishlist::where('user_id',$user_id)->with('product')
       ->get();
       //dd($whishlists); 
                    
        /*
        $user_orders = DB::table('order_product')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select('products.*', 'orders.total_price','orders.created_at')
            ->where('orders.user_id', $user_id)
            ->get();
            //dd($user_orders);*/
        return view('Users.profile',compact('user_orders'),compact('whishlists'));
    }

    //user logout
     public function logout(){
        Auth::logout();
        return redirect()->back();
    }  
    
}
