<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User Order one-to-many relationship
    public function order(){
        return $this->hasMany(Order::class);
    }

    //user has one Profile
 
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    //User Review one-to-Many relationship

    public function review(){
        return $this->hasMany(Review::class);
    }


   //user Whishlist One-to-one Relationship
   public function whishlist(){
    return $this->hasOne(Whishlist::class);
   }

   //User Comment one-to-Many relationship
   public function comment(){
        return $this->hasMany(Comment::class);
    }


}
