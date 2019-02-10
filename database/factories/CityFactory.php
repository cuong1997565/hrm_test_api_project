<?php

use App\Repositories\Cities\City;

$factory->define(City::class, function (Faker\Generator $faker){
    // $allCityId     = \App\Repositories\Cities\City::all()->pluck('id')->toArray();

    return [
        'name'        => $faker->unique()->name,
        'slug'     => $faker->company,
        'zipcode'       => $faker->name
    ];
});
