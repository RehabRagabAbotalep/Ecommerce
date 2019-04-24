<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Review;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $comment = new Comment;
        $user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->user_id = $user_id;
        $review = Review::find($request->review_id);
        $review->comment()->save($comment);
        return back();
    }


     public function reply(Request $request)
    {   
       // $reply = Comment::where('parent_id',$request->comment_id)->count();
        //if($reply<5){
            $reply = new Comment;
            $user_id = Auth::user()->id;
            $reply->comment = $request->reply;
            $reply->user_id = $user_id;
            $reply->parent_id = $request->comment_id;
            $review = Review::find($request->review_id);
            $review->comment()->save($reply);
            //$reply = Comment::where('parent_id',$request->comment_id)->get();
           // return $reply;

            return back();

       // }
      // else{
       // return back();
       //}

    }
    }
