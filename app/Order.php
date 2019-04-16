<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['total_price','user_id','status'];

    //order product Many-to-Many relationship
    public function product(){
    	return $this->belongsToMany(Product::class);
    }


    //User Order one-to-many relationship
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
