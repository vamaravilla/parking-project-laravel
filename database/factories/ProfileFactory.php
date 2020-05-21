<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'paymentrequired' =>  true,
        'paymentperiod' => $faker->name,
        'amoutperunit' => 0.05
    ];
});
