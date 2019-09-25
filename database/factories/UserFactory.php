<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = ['kingsley Frank-Demesi', 'Smart Omileye', 'Gabriel Afunso'];
    $email = ['kingsley@gmail.com', 'smartomileye@gmail.com', 'gabrielafunso@gmail.com'];
    $index = $faker->unique()->numberBetween(0, 2);

    return [
        'name' =>  $name[$index],
        'email' => $email[$index],
        'active' => 1,
        'isAdmin' => $email[$index] === $email[0] ? true : false,
        'password' => bcrypt('Password1')
    ];
});
