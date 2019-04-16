<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserResource;
use Symfony\Component\HttpFoundation\Response;
use Hash;
use Auth;
use DB;
use App\User;
class UserController extends Controller
{	

	public $successStatus = 200;

	public function __construct(){
		$this->middleware('auth:api');
	}

    public function register(UserRequest $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();
    	return response([
            'data' =>new UserResource($user)
        ],Response::HTTP_CREATED);
    }

    public function login(Request $request){
    	$request ->validate([
    		'email'    =>'required|email|',
    		'password' =>'required|min:4'
    	]);
    
    	 if (Auth::guard('web')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();



            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 

    		}

    }//end Login

    public function logout(){
    	 $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
