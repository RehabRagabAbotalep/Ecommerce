<?php

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Category;
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

$factory->define(Product::class, function (Faker $faker) {
    return [
    	'category_id'=>Category::all()->random(),
        'name' => $faker->word,
        'description' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
        'price' =>$faker->numberBetween(100,1000),
        'code' =>$faker->isbn10,
        'image' => $faker->imageUrl(100, 100),
        
    ];
});
