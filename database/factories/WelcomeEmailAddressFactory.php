<?php

use Faker\Generator as Faker;

$factory->define(\App\WelcomeEmailAddress::class, function (Faker $faker) {
    return [
        'email' => $faker->email()
    ];
});
