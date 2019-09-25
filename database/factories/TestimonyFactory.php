<?php

use Faker\Generator as Faker;

$factory->define(App\Testimony::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail(),
        'testimony' => $faker->text(300),
        'approval' => $faker->numberBetween(0, 1),
    ];
});
