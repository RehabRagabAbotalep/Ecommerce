<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['review','star','user_id','product_id'];

    //Review Product one-to-many Relationship
    public function product(){
    	return $this->belongsTo(Product::class);
    }

    
    //User review one-to-one Relationship
    public function user(){
    	return $this->belongsTo(User::class);
    }

      public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
