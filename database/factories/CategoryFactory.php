<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "c_name"   => $faker->name(),
        "c_banner" => $faker->imageUrl(),
    ];
});
