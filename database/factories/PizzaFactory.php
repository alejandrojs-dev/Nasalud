<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pizza;
use Faker\Generator as Faker;

$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(3, true),
        'tamano' => $faker->word,
        'precio' => $faker->randomFloat(2, 0, 3)
    ];
});
