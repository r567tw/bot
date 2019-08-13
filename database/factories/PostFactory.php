<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'   => $faker->word,
        'content' => $faker->realText,
        'user_id' => function(){
            return factory('App\User')->create()->id;
        }
    ];
});
