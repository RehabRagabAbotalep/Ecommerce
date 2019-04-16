<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'image','category_id','code','whishlist_id'
    ];
    //category product one-to-many relationship
    public function category(){
    	return $this->belongsTo(Category::class, 'category_id');
    }

    //Product Order Many To Many Relationship
    public function order(){
    	return $this->belongsToMany(Order::class);
    }


    //Product hasMany Review
    public function review(){
        return $this->hasMany(Review::class);
    }
    //Product whishlist Many-To-Many Relationship
    public function whishlist(){
        return $this->belongsToMany(Whishlist::class);
    }
   
}
