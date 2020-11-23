<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use LaravelViews\Test\Database\FoodTest;

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

$factory->define(FoodTest::class, function (Faker $faker) {
    return [
        'name' => str_replace("'", "", $faker->name),
        'description' => $faker->sentence(40),
        'photo' => $faker->imageUrl()
    ];
});
