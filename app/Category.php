<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    
    //category product one-to-many relationship

    public function product(){
    	return $this->hasMany(Product::class);
    }
}
