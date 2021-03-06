<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'branch_name'=>$faker->name,
        'contact_name'=>$faker->name,
        'contact_email'=>$faker->email,
        'contact_no'=>$faker->phoneNumber,
        'phone'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'address'=>$faker->address,
        'city'=>$faker->city,
        'state'=>$faker->state,
        'is_active'=>true,
        'is_suspended'=> true,
    ];
});
