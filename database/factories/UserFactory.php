<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    
    return [
        'name' => $faker->name,
        'sub' => $faker->sentence,
        'email' => $faker->unique()->safeEmail,
        'picture' => $faker->sentence,
        'posts' => random_int(1, 15),
        'remember_token' => Str::random(10),
    ];
});
