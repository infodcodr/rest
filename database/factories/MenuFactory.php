<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
         'title'=>$faker->name,
         'description'=>$faker->text,
         'is_active'=>true
    ];
});
