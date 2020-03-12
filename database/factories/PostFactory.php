<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) { 

    return [
        'heading' => $faker->sentence,
        'content' => $faker->paragraph,
        'sub' => App\User::all()->random()->sub,
        'image' => $faker->sentence,
        'nsfw' => $faker->boolean,
    ];
});
