<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Items;
use Faker\Generator as Faker;

$factory->define(Items::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'title'=>$faker->title,
        'description'=>$faker->text,
        'amount'=>$faker->randomNumber(3),
        'is_veg'=> true,
        'is_active'=>true
    ];
});
