<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;


$factory->define(Comment::class, function (Faker $faker) {

    return [
        'content' => $faker->paragraph,
        'sub' => App\User::all()->random()->sub,
        'post_id' => App\Post::all()->random()->id,
    ];
});
