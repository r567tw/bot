<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Chat;
use Faker\Generator as Faker;

$factory->define(App\Chat::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'message' => $faker->sentence()
    ];
});
