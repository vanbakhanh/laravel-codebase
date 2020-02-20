<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName('male'|'female'),
        'last_name' => $faker->lastname,
        'avatar' => config('constants.avatar_default'),
        'address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => rand(0, 1),
    ];
});
