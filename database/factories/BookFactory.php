<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Book::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'category' => $faker->unique()->safeEmail,
        'year' => $faker->name,
        'remember_token' => str_random(10),
    ];
});
