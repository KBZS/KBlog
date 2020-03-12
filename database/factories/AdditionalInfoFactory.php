<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AdditionalInfo;
use Faker\Generator as Faker;


$factory->define(AdditionalInfo::class, function (Faker $faker) { 

    return [
        'is_verified' => FALSE,
        'is_admin' => FALSE,
        'is_moderator' => FALSE,
        'sub' => App\User::all()->random()->sub,
        'phone_num' => $faker->phoneNumber,
    ];
});