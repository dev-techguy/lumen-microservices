<?php

/** @var Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10, true),
        'description' => $faker->realText(20, true),
        'price' => $faker->numberBetween(100, 200),
        'author_id' => $faker->numberBetween(1, 50),
    ];
});
