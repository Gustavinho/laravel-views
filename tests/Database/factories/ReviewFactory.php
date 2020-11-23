<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use LaravelViews\Test\Database\ReviewTest;

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

$factory->define(ReviewTest::class, function (Faker $faker) {
    return [
        'food_id' => random_int(1, 10),
        'user_id' => random_int(1, 10),
        'message' => $faker->text,
    ];
});
