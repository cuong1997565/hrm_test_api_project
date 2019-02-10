<?php

use App\Repositories\Districts\District;

$factory->define(District::class, function (Faker\Generator $faker){
    return [
        'name'          => $faker->unique()->name,
        'slug'          => $faker->company,
        'zipcode'       => $faker->name,
        'city_id'       => 1
    ];
});
