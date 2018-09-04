<?php

use Faker\Generator as Faker;

$factory->define(App\PCO\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
