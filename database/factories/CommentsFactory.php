<?php

use Faker\Generator as Faker;
use App\Model\Comment\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    static $number = 0;
    $parent_id = $faker->numberBetween($min = 0, $max = $number++);
    return [
        Comment::PROP_USER_NAME => $faker->firstName,
        Comment::PROP_PARENT_ID => ($parent_id === 0) ? null : $parent_id,
        Comment::PROP_TEXT      => $faker->text(500),
    ];
});
