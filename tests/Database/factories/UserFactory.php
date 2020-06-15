<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use LaravelViews\Test\Database\UserTest;

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

$factory->define(UserTest::class, function (Faker $faker) {
    return [
        'name' => str_replace("'", "", $faker->name),
        'email' => $faker->unique()->safeEmail,
        'is_admin' => $faker->randomElement([true, false]),
        'is_writer' => $faker->randomElement([true, false]),
        'active' => $faker->randomElement([true, false]),
        'avatar' => $faker->randomElement([
            'https://gravatar.com/avatar/70d54a7e7b8a5d91e0ae87b99ccb3d61?s=400&d=robohash&r=x',
            'https://gravatar.com/avatar/5d913d0e61f6ad19b61b27d1bc350363?s=400&d=robohash&r=x',
            // 'https://robohash.org/b842dace7186de3c8fc52ac691b585a7?set=set4&bgset=&size=400x400',
            'https://gravatar.com/avatar/bc8f81437562a9def3992885573bdec5?s=400&d=robohash&r=x',
            'https://gravatar.com/avatar/50746d27c0ecedf70fa5c3934cfe4ead?s=400&d=robohash&r=x',
            'https://gravatar.com/avatar/a7ecb9ab617ef620ee3b8ade1d695f90?s=400&d=robohash&r=pg',
            'https://gravatar.com/avatar/6b661cba4ce7d0038f6c2e5881005e49?s=400&d=robohash&r=pg',
            'https://gravatar.com/avatar/94f1d9a644c6d5b36c9aec515fdaa5d1?s=400&d=robohash&r=pg',
            'https://gravatar.com/avatar/619bb911835caa313806aba5ad2e13cc?s=400&d=robohash&r=pg',
            'https://gravatar.com/avatar/d4c58fa6c7485d5f4b74d74a37779757?s=400&d=robohash&r=pg',
            'https://gravatar.com/avatar/02313d0fa22f1f507630b6a4c32e251f?s=400&d=robohash&r=pg'
        ])
    ];
});
