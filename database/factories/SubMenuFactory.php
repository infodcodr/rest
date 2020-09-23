<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubMenu;
use Faker\Generator as Faker;

$factory->define(SubMenu::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
         'title'=>$faker->name,
         'description'=>$faker->text,
         'is_active'=>true
    ];
});
