<?php

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "category_id" => Category::all()->random()->id,
        "p_name" => $faker->unique()->company,
        "p_code" => "ABC".random_int(100, 10000),
        "p_banner" => $faker->imageUrl(),
        "p_description" => $faker->realText(),
        "p_price" => random_int(100, 1000),
    ];
});
