<?php

use App\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Product;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Review::class, function (Faker $faker) {
    return [
    	'product_id'=>Product::all()->random(),
    	
    	'user_id'=> User::all()->random(),
    	
        'review' => $faker->paragraph,
        'star' =>$faker->numberBetween(0,5),
        
        
    ];
});
