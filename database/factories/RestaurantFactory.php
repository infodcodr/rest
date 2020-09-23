<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
         'contact_name'=>$faker->name ,
         'contact_email'=>$faker->email,
         'contact_no'=>$faker->phoneNumber ,
         'phone'=>$faker->phoneNumber,
         'email'=>$faker->email,
         'address'=>$faker->address,
         'city'=>$faker->city,
         'state'=>$faker->name,
         'pincode'=>$faker->postcode  ,
         'is_active'=> true,
         'is_suspended'=>true

    ];
});
