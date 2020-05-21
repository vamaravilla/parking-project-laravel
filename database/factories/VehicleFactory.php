<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'owner' => $faker->name,
        'profile' => $faker->name,
        'registrationnumber' => $faker->creditCardNumber,
    ];
});
