<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Parking;
use Faker\Generator as Faker;

$factory->define(Parking::class, function (Faker $faker) {
    return [
        'vehicle' => $faker->creditCardNumber,
        'profile' =>  $faker->name,
        'month' => 'May',
        'intime' => time(),
    ];
});
