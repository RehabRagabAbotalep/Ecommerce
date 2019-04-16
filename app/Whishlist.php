<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whishlist extends Model
{
    //protected $fillable = ['user_id'];

    //Product whishlist Many-To-Many Relationship
    public function product(){
    	return $this->belongsToMany(Product::class);
    }

    //User Whishlist One-To-One Relationship
     public function user(){
    	return $this->belongsTo(User::class);
    }
}
