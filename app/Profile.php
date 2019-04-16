<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['photo', 'user_id', 'facebook','about'];


    //Profile belongs To One User
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
