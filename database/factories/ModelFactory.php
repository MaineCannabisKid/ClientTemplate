<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// Posts Seeder
$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->unique()->realText(50),
        'body' => $faker->unique()->paragraphs(5, true),
        'slug' => $faker->slug,
        'created_at' => $faker->dateTimeBetween("now", "+ 6 months"),
        'updated_at' => $faker->dateTimeBetween("+ 6 months", "+ 1 year 6 months"),
    ];
});